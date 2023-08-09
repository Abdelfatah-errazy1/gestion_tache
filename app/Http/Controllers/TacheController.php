<?php

namespace App\Http\Controllers;

use App\Models\Contraint;
use App\Models\Prerequis;
use App\Models\Tache;
use Illuminate\Http\Request;

class TacheController extends Controller
{
    public function index()  {
        $taches=Tache::all();
        return view('taches.index',compact('taches'));
    }
    public function create()  {
       
        return view('taches.create');
    }
    public function edit($id)  {
        $model=Tache::find($id);
        $prerequis=Prerequis::query()->where('tache',$id)->get();
        $contraints=Contraint::query()->where('tache',$id)->get();
        return view('taches.edit',compact('model','contraints','prerequis'));
    }
    public function store(Request $request)  {
        $validate=$request->validate([
            'titre'=>'required|string|max:150',
            'description'=>'required|string',
            'priorite'=>'required|in:1,2,3,4,5',
            'statut'=>'required|in:1,2,3,4,5',
            'date_debut'=>'required|date',
            'date_fin'=>'required|date',
            'date_effective'=>'required|date',
        ]);
        
        $model=Tache::create($validate);
        // dd($validate);
        return redirect(route('taches.edit',$model->id));
    }
    public function update(Request $request,$id)  {
        $validate=$request->validate([
            'titre'=>'required|string|max:150',
            'description'=>'required|string',
            'priorite'=>'required|in:1,2,3,4,5',
            'statut'=>'required|in:1,2,3,4,5',
            'date_debut'=>'required|date',
            'date_fin'=>'required|date',
            'date_effective'=>'required|date',
        ]);
        $model=Tache::find($id);
        $model->update($validate);
        return redirect(route('taches.index'));
    }
    public function delete($id)  {
        Tache::find($id)->delete();
        return redirect(route('taches.index'));
    }
}
