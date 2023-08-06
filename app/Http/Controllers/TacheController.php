<?php

namespace App\Http\Controllers;

use App\Models\Tache;
use Illuminate\Http\Request;

class TacheController extends Controller
{
    public function index()  {
        $taches=Tache::all();
        return view('index');
    }
    public function create()  {
       
        return view('taches.create');
    }
    public function edit($id)  {
        $tache=Tache::find($id);
        return view('taches.edit',compact('tache'));
    }
    public function store(Request $request)  {
        $validate=$request->validate([
            'nom'=>'required'
        ]);

        Tache::create($validate);
        return redirect(route('tache.index'));
    }
    public function update(Request $request,$id)  {
        $validate=$request->validate([
            'nom'=>'required'
        ]);

        Tache::create($validate);
        return redirect(route('tache.index'));
    }
    public function delete($id)  {
        Tache::find($id)->delete();
        return redirect(route('tache.index'));
    }
}
