<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Categoria;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class PerfilController extends Controller
{
    public function index(){
        $user = User::where('id', Auth::id())->get();
        $categorias = Categoria::get();

        return view('perfil.index', compact('user','categorias'));
    }
}
