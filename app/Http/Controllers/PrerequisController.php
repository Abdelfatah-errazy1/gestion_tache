<?php

namespace App\Http\Controllers;

use App\Models\Prerequis;
use Illuminate\Http\Request;

class PrerequisController extends Controller
{
    public function store(Request $request)  {
        $validate=$request->validate([
            'prerequis'=>'required|string|max:150',
            'tache'=>'required|exists:taches,id',
        ]);
        
        $model=Prerequis::create($validate);
        // dd($validate);
        return redirect(route('taches.edit',$model->tache));
    }
    public function update(Request $request,$id)  {
        $validate=$request->validate([
            'prerequis'=>'required|string|max:150',
            'tache'=>'required|exists:taches,id',
        ]);
        $model=Prerequis::find($id);
        $model->update($validate);
        redirect(route('taches.edit',$model->tache));;
    }
    public function delete($id)  {
        $model=Prerequis::find($id);
        $model->delete();
        redirect(route('taches.edit',$model->tache));
    }


}
