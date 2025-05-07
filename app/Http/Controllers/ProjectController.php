<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects= Project::all();
        return view('pages.projects.index',compact('projects'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'required|string|in:pending,in_progress,completed',
        ]);

        $validated['user_id']=auth()->user()->id;
         Project::create($validated);
         return redirect(route('projects.index'));
        
    }

    public function create()
    {
        return view('pages.projects.create');

    }
    public function edit($id)
    {
        $model=Project::find($id);
        return view('pages.projects.edit',compact('model'));

    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'required|string|in:pending,in_progress,completed',
        ]);
        $Project=Project::find($id);
        $Project->update($validated);
        return redirect(route('projects.index'));


    }

    public function destroy( $id)
    {
        $Project=Project::find($id);

        $Project->delete();
        return redirect(route('projects.index'));

    }
}
