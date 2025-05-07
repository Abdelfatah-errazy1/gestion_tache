<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles= Role::all();
        return view('pages.roles.index',compact('roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

         Role::create($validated);
         return redirect(route('roles.index'));
        
    }

    public function create()
    {
        return view('pages.roles.create');

    }
    public function edit($id)
    {
        $model=Role::find($id);
        return view('pages.roles.edit',compact('model'));

    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'color' => 'nullable|string|max:20',
        ]);
        $taskroles=Role::find($id);
        $taskroles->update($validated);
        return redirect(route('roles.index'));


    }

    public function destroy( $id)
    {
        $taskroles=Role::find($id);

        $taskroles->delete();
        return redirect(route('roles.index'));

    }
}
