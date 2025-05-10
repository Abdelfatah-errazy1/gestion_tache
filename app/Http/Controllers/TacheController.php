<?php

namespace App\Http\Controllers;

use App\Models\Contraint;
use App\Models\Prerequis;
use App\Models\Project;
use App\Models\Tache;
use App\Models\TaskCategory;
use App\Models\TaskTag;
use App\Models\User;
use App\Notifications\TaskAssignedNotification;
use App\Notifications\TaskCommentAddedNotification;
use App\Notifications\TaskCompletedNotification;

use App\Notifications\TaskFeedbackGivenNotification;
use App\Notifications\TaskProgressUpdatedNotification;
use App\Notifications\TaskStatusChangedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TacheController extends Controller
{
    public function index(Request $request)  {
    
        $taches=Tache::with('category', 'tags', 'project', 'user')->latest()->paginate(10);
        return view('taches.index',compact('taches'));
    }
    public function create()  {
        $categories = TaskCategory::all();
        $tags = TaskTag::all();
        $users = User::all();
        $projects = Project::all();

        return view('taches.create', compact('categories', 'tags', 'users', 'projects'));
     }
    public function show($id)  {
        $model=Tache::find($id);
        $prerequis=Prerequis::query()->where('tache',$id)->get();
        $contraints=Contraint::query()->where('tache',$id)->get();
        $users = User::whereNotIn('id', function ($query) use ($id) {
            $query->select('user')->from('responsables')->where('tache', $id);
        })->get();
        
        $roles=DB::select('select * from roles ');
        $contraints=Contraint::query()->where('tache',$id)->get();
        $responsables = DB::table('responsables')
        ->join('users', 'responsables.user', '=', 'users.id')
        ->join('roles', 'responsables.role', '=', 'roles.id')
        ->join('taches', 'responsables.tache', '=', 'taches.id')
        ->where('taches.id', $id)
        ->select('responsables.*', 'users.name', 'roles.name')
        ->get();
        return view('taches.show',compact('model','contraints','prerequis','users','roles','responsables'));
    }
    public function edit($id)  {
        $model=Tache::find($id);
        $prerequis=Prerequis::query()->where('tache',$id)->get();
        $contraints=Contraint::query()->where('tache',$id)->get();
        $users = User::whereNotIn('id', function ($query) use ($id) {
            $query->select('user')->from('responsables')->where('tache', $id);
        })->get();
        
        $roles=DB::select('select * from roles ');
        $contraints=Contraint::query()->where('tache',$id)->get();
        $responsables = DB::table('responsables')
        ->join('users', 'responsables.user', '=', 'users.id')
        ->join('roles', 'responsables.role', '=', 'roles.id')
        ->join('taches', 'responsables.tache', '=', 'taches.id')
        ->where('taches.id', $id)
        ->select('responsables.*', 'users.name', 'roles.name as role_name')
        ->get();
        $categories = TaskCategory::all();
        $tags = TaskTag::all();
        $users = User::all();
        $projects = Project::all();
        return view('taches.edit',compact('model','contraints','prerequis','users','roles','responsables','categories', 'tags', 'users', 'projects'));
    }
    public function store(Request $request)  {
        $validate = $request->validate([
            'titre' => 'required|string|max:100',
            'description' => 'required|string',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'date_effective' => 'nullable|date',
            'priorite' => 'required|in:1,2,3,4,5',
            'statut' => 'required|in:1,2,3,4,5',
            'progress' => 'nullable|integer|min:0|max:100',
            'category_id' => 'nullable|exists:task_categories,id',
            'project_id' => 'nullable|exists:projects,id',
            'assigned_to' => 'nullable|exists:users,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:task_tags,id',
        ]);

        
        // dd($validate);
        $validate['created_by'] = auth()->id();
        $model=Tache::create($validate);
        if ($request->has('tags')) {
            $model->tags()->sync($request->tags);
        }
        // dd($validate);
        return redirect(route('taches.edit',$model->id))->with('success','saved correct');
    }
    public function update(Request $request,$id)  {
        $data = $request->validate([
            'titre' => 'required|string|max:100',
            'description' => 'required|string',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'date_effective' => 'nullable|date',
            'priorite' => 'required|in:1,2,3,4,5',
            'statut' => 'required|in:1,2,3,4,5',
            'progress' => 'nullable|integer|min:0|max:100',
            'category_id' => 'nullable|exists:task_categories,id',
            'project_id' => 'nullable|exists:projects,id',
            'assigned_to' => 'nullable|exists:users,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:task_tags,id',
        ]);


        $model=Tache::find($id);
        $user=User::find($model->assigned_to);
        $user->notify(new TaskAssignedNotification($model));

        $model->update($data);
        if ($request->has('tags')) {
            $model->tags()->sync($request->tags);
        }
        return redirect(route('taches.index'));
    }
    public function delete($id)  {
        Tache::find($id)->delete();
        return redirect(route('taches.index'));
    }
    public function affecter(Request $request,$id)  {
        $validate=$request->validate([
            'user'=>'required|exists:users,id',
            'role'=>'required|exists:roles,id',  
        ]);
        DB::insert('insert into responsables(user,tache,role) values (?, ?,?)',[$validate['user'],$id,$validate['role']]);

        return redirect(route('taches.edit',$id));
    }
    public function userTaches(Request $request,$id)  {
        $taches=Tache::with('category', 'tags', 'project', 'user','comments')
            ->where('assigned_to',auth()->user()->id)->latest()
            ->paginate(10);
        return view('pages.userTaches.index',compact('taches'));

    }

    public function feedback(Request $request, $id)
{
    $tache = Tache::findOrFail($id);
    $tache->feedbacks()->create([
        'user_id' => auth()->id(),
        'feedback' => $request->feedback,
    ]);
    $admin=User::query()->where('is_admin',true)->first();

    $admin->notify(new TaskFeedbackGivenNotification($tache, $request->feedback));
    return redirect()->back()->with('success', 'Feedback submitted successfully.');
}

public function comment(Request $request, $id)
{
    $tache = Tache::findOrFail($id);
    $tache->comments()->create([
        'user_id' => auth()->id(),
        'comment' => $request->comment,
    ]);
    $assignee=User::query()->where('id',$tache->assigned_to)->first();
    $admin=User::query()->where('is_admin',true)->first();

    $assignee->notify(new TaskCommentAddedNotification($tache, $request->comment));
    $admin->notify(new TaskCommentAddedNotification($tache, $request->comment));
    return redirect()->back()->with('success', 'Comment added successfully.');
}

// Update only progress
public function updateProgress(Request $request, $id)
{
    $tache = Tache::findOrFail($id);
    $tache->progress = $request->progress;
    $tache->save();
    $admin=User::query()->where('is_admin',true)->first();

    $admin->notify(new TaskProgressUpdatedNotification($tache, $tache->progress));
    return back()->with('success', 'Progress updated successfully.');
}

// Mark task as complete (set statut = 5)
public function markComplete($id)
{
    $tache = Tache::findOrFail($id);
    $tache->statut = 3;
    $tache->save();
    // dd($tache);
    $admin=User::query()->where('is_admin',true)->first();
    $assignee=User::query()->where('id',$tache->assigned_to)->first();

    $admin->notify(new TaskCompletedNotification($tache));
    $assignee->notify(new TaskStatusChangedNotification($tache, $tache->status));
    $admin->notify(new TaskStatusChangedNotification($tache, $tache->status));
    return back()->with('success', 'Task marked as complete.');
}


    
}
