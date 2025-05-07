<?php

namespace App\Http\Controllers;

use App\Models\TaskCategory;
use Illuminate\Http\Request;

class TaskCategoryController extends Controller
{
    public function index()
    {
        $categories= TaskCategory::all();
        return view('pages.category.index',compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'color' => 'nullable|string|max:20',
        ]);

         TaskCategory::create($validated);
         return redirect(route('category.index'));
        
    }

    public function create()
    {
        return view('pages.category.create');

    }
    public function edit($id)
    {
        $model=TaskCategory::find($id);
        return view('pages.category.edit',compact('model'));

    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'color' => 'nullable|string|max:20',
        ]);
        $taskCategory=TaskCategory::find($id);
        $taskCategory->update($validated);
        return redirect(route('category.index'));


    }

    public function destroy( $id)
    {
        $taskCategory=TaskCategory::find($id);

        $taskCategory->delete();
        return redirect(route('category.index'));

    }

}
