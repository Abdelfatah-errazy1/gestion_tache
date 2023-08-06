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
}
