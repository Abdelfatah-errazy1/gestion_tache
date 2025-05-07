<?php

namespace App\Http\Controllers;

use App\Models\TaskTag;
use Illuminate\Http\Request;

class TaskTagController extends Controller
{
    public function index()
    {
        $tags= TaskTag::all();
        return view('pages.tags.index',compact('tags'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'color' => 'nullable|string|max:20',
        ]);

         TaskTag::create($validated);
         return redirect(route('tag.index'));
        
    }

    public function create()
    {
        return view('pages.tags.create');

    }
    public function edit($id)
    {
        $model=TaskTag::find($id);
        return view('pages.tags.edit',compact('model'));

    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'color' => 'nullable|string|max:20',
        ]);
        $taskCategory=TaskTag::find($id);
        $taskCategory->update($validated);
        return redirect(route('tag.index'));


    }

    public function destroy( $id)
    {
        $taskCategory=TaskTag::find($id);

        $taskCategory->delete();
        return redirect(route('tag.index'));

    }
}
