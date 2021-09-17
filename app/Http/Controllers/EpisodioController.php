<?php

namespace App\Http\Controllers;
use App\Models\Epsodio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Curtida;
use App\Models\PlaylistEp;


class EpisodioController extends Controller
{
    public function index(){
        return view('canal.index');
    }
    
    //posta novo ep
    public function episodio(Request $request)
    {
        //verifcando se todos os campos foram preenchidos
        $rule = array(
            'nome_ep' => 'required',
            'audio_ep' => 'required',
        );

        $messages = [
            'nome_ep.required' => 'Campo nome obrigatório',
            'audio_ep.required' => 'Adicione um áudio',
        ];

        $validator = Validator::make($request->all(), $rule, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->messages());
        }

        //verifica se o user enviou o audio ep
        if (file_exists($request->file('audio_ep'))) {
            $extension = $request->file('audio_ep')->extension(); //pegando a extension do arquivo

            //pegando duration do audio
            $getID3 = new \getID3;
            $file = $getID3->analyze($request->file('audio_ep'));
            $playtime_seconds = $file['playtime_seconds'];
            $duration = gmdate("H:i:s", $playtime_seconds);
     
            $nome_audio = uniqid() . '.' . $extension; //dando um nove unico para o arquivo
            $request->file('audio_ep')->storeAs('audio_ep', $nome_audio); //salvando audio na pasta

            //salvando os dados na tabela
            Epsodio::insert([
                'name_ep' => $request['nome_ep'],
                'temp_audio' => $duration,
                'name_audio' => $nome_audio,
                'id_user' => Auth::id(),
                'created_at' => date("Y-m-d H:m:s"),
                'updated_at' => date("Y-m-d H:m:s")
            ]);
        }

        return back()->with('success', 'Episódio adicionada com sucesso');
    }

    //usuario dono do ep excluir o ep que ele subiu
    public function delete_ep(Request $request){
        Epsodio::where('id', $request['id_ep'])->delete();
        Curtida::where('id_ep',$request['id_ep'])->delete();
        PlaylistEp::where('id_ep',$request['id_ep'])->delete();

        return true;
    }
}
