<?php

namespace App\Http\Controllers;
use App\Models\Categoria;
use App\Models\User;
use App\Models\Epsodio;

use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index(){
        $categorias = Categoria::get();

        return view('categoria.index', compact('categorias'));
    }

    public function categoria($id){
        $categoria = Categoria::where('id', $id)->get();
        $podcast = User::where('id_categoria', $id)->get();

        return view('categoria.categoria', compact('podcast','categoria'));
    }

    public function show($id){
        $data = User::where('id', $id)->get();
        $eps = Epsodio::where('id_user', $id)->get();

        return view('categoria.show', compact('data','eps'));
    }
}
