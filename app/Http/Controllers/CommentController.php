<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $categories= Comment::all();
        return view('pages.category.index',compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'color' => 'nullable|string|max:20',
        ]);

         Comment::create($validated);
         return redirect(route('category.index'));
        
    }

    public function create()
    {
        return view('pages.category.create');

    }
    public function edit($id)
    {
        $model=Comment::find($id);
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
        $Comment=Comment::find($id);
        $Comment->update($validated);
        return redirect(route('category.index'));


    }

    public function destroy( $id)
    {
        $Comment=Comment::find($id);

        $Comment->delete();
        return redirect(route('category.index'));

    }
}
