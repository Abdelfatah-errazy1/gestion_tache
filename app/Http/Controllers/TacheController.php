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
}
