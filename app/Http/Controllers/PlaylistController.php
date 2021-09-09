<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlaylistController extends Controller
{
    public function index(){
        return view('playlist.index');
    }
}
