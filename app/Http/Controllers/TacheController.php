<?php

namespace App\Http\Controllers;

use App\Models\Contraint;
use App\Models\Prerequis;
use App\Models\Project;
use App\Models\Tache;
use App\Models\TaskCategory;
use App\Models\TaskTag;
use App\Models\User;
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
}
