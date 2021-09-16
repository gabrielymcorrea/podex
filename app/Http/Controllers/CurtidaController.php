<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curtida;
use Illuminate\Support\Facades\Auth;
use App\Models\Playlist;

class CurtidaController extends Controller
{
    public function index(){
        $curtidas = Curtida::join('epsodios', 'epsodios.id', '=', 'curtidas.id_ep')
        ->where('curtidas.id_user', Auth::id())->get(['epsodios.*']);

        $playlist = Playlist::where('id_user', Auth::id())->get();
        return view('curtida.index', compact('curtidas','playlist'));
    }

    //add curtida e tirar curtida
    public function curtida(Request $request){
        if($request['acao'] == 1){ //1 para add curtida
            Curtida::insert([
                'id_ep' => $request['id_ep'],
                'id_user' => Auth::id(),
                'created_at' => date("Y-m-d H:m:s"),
                'updated_at' => date("Y-m-d H:m:s")
            ]);
        }

        if($request['acao'] == 2){ //2 para tirar curtida
            Curtida::where('id_user',Auth::id())->where('id_ep',$request['id_ep'])->delete();
        }


        return true;
    }
}
