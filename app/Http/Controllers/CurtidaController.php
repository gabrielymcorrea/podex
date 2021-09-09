<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CurtidaController extends Controller
{
    public function index(){
        return view('curtida.index');
    }
}
