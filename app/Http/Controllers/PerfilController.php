<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Categoria;
use App\Models\Epsodio;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class PerfilController extends Controller
{
    public function index(){
        $user = User::where('id', Auth::id())->get();
        $categorias = Categoria::get();

        return view('perfil.index', compact('user','categorias'));
    }

    //posta novo ep
    public function episodio(Request $request){

       

        //verifcando se todos os campos foram preenchidos
        $rule = array(
			'nome_ep' => 'required',
			'audio_ep' => 'required',
		);

        $messages = [
            'nome_ep.required' => 'Campo nome obrigatório',
            'audio_ep.required' => 'Adicione um áudio',
        ];

		$validator = Validator::make($request->all(),$rule,$messages);


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
            $duration = date('H:i:s', $playtime_seconds);

            $nome_audio = uniqid() . '.' . $extension; //dando um nove unico para o arquivo
            $request->file('audio_ep')->storeAs('audio_ep', $nome_audio); //salvando audio na pasta
        }

        //salvando os dados na tabela
        Epsodio::insert([
            'name_ep' => $request['nome_ep'],
            'temp_audio' => $duration,
            'name_audio' => $nome_audio,
            'id_user' => Auth::id(),
            'created_at' => date("Y-m-d H:m:s"),
            'updated_at' => date("Y-m-d H:m:s")
        ]);

        return back()->with('success', 'Episódio adicionada com sucesso');
    }

    //criar canal/atualizar dados do canal
    public function canal(Request $request){
        //salvando dados na tabela
        User::where('id', Auth::id())->update([
            'descricao' => isset($request['descricao']) ? $request['descricao'] : '',
            'name_podcast' => isset($request['name_podcast']) ? $request['name_podcast'] : '',
            'id_categoria' => isset($request['categoria']) ? $request['categoria'] : '',
        ]);

        return back()->with('success', 'Dados atualizados com sucesso');
    }
}