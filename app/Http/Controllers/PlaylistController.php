<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Playlist;
use App\Models\PlaylistEp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PlaylistController extends Controller
{
    public function index(){
        $playlists = Playlist::where('id_user', Auth::id())->get();
        return view('playlist.index', compact('playlists'));
    }

    public function add_playlist(Request $request){
        $retorno = [];
        //total de playlist
        $total = Playlist::where('id_user', Auth::id())->get()->count();
        $total = $total + 1;
        $name_playlist = 'Playlist '.$total;

        //uma nova playlist 
        if($request->id_playlist == 0){
            Playlist::insert([
                'nome' => $name_playlist,
                'id_user' => Auth::id(),
                'created_at' => date("Y-m-d H:m:s"),
                'updated_at' => date("Y-m-d H:m:s")
            ]);

            $id_playlist = DB::getPdo()->lastInsertId();

            $retorno['acao'] = 'Playlist criada com sucesso';
        }else{
            $id_playlist = Playlist::where('id_user', Auth::id())->where('id',$request->id_playlist)->get();
            $id_playlist = $id_playlist[0]->id;
        }

        $ja_adicionado = PlaylistEp::where('id_ep',$request->id_ep)->where('id_playlist', $id_playlist)->get();

        //verificando se esse ep já está de playlist
        if(count($ja_adicionado) == 0){
            //inserir ep na playlist
            PlaylistEp::insert([
                'id_playlist' => $id_playlist,
                'id_ep' =>$request->id_ep,
                'created_at' => date("Y-m-d H:m:s"),
                'updated_at' => date("Y-m-d H:m:s")
            ]);

            $retorno['status'] = 1;
            return true;
        }
            
        $retorno['status'] = 0;
        return true;
    }

    public function show_playlist($id){
        $playlist = Playlist::join('playlist_eps', 'playlist_eps.id_playlist', '=', 'playlists.id')
            ->join('epsodios', 'epsodios.id', '=', 'playlist_eps.id_ep')
            ->where('playlists.id_user', Auth::id())
            ->where('playlists.id', $id)
            ->get(['playlists.nome', 'epsodios.*']);

        return view('playlist.show', compact('playlist'));
    }

    public function delete_playlist($id){//id da playlist
        Playlist::where('id_user',Auth::id())->where('id',$id)->delete();
        PlaylistEp::where('id_playlist', $id)->delete();

        return true;
    }
}
