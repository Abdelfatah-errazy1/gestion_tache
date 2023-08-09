<?php

namespace App\Http\Controllers;

use App\Models\Contraint;
use Illuminate\Http\Request;

class ContraintController extends Controller
{
    
    public function store(Request $request)  
    {
        // dd($request);
        $validate=$request->validate([
            'contraint'=>'required|string|max:150',
            'tache'=>'required|exists:taches,id',
        ]);
        
        $model=Contraint::create($validate);
        // dd($validate);
        return redirect(route('taches.edit',$model->tache));
    }
    public function update(Request $request,$id)  {
        $validate=$request->validate([
            'contraint'=>'required|string|max:150',
            'tache'=>'required|exists:taches,id',
        ]);
        $model=Contraint::find($id);
        $model->update($validate);
        redirect(route('taches.edit',$model->tache));;
    }
    public function delete($id)  {
        $model=Contraint::find($id);
        Contraint::find($id)->delete();
       return redirect(route('taches.edit',$model->tache));
    }

}
