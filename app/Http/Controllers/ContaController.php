<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Categoria;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContaController extends Controller
{
    public function index(){
        $user = User::where('id', Auth::id())->get();
        $categorias = Categoria::get();

        return view('conta.index', compact('user', 'categorias'));
    }

    //criar canal/atualizar dados do canal
    public function canal(Request $request)
    {
        //verifcando se todos os campos foram preenchidos
          $rule = array(
            'name' => 'required',
            'email' => 'required',
        );

        $messages = [
            'name.required' => 'Campo nome obrigatório',
            'email.required' => 'Campo email obrigatório',
        ];

        $validator = Validator::make($request->all(), $rule, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->messages());
        }
        
        //salvando dados na tabela
        User::where('id', Auth::id())->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'descricao' => isset($request['descricao']) ? $request['descricao'] : '',
            'name_podcast' => isset($request['name_podcast']) ? $request['name_podcast'] : '',
            'id_categoria' => isset($request['categoria']) ? $request['categoria'] : '',
        ]);

        //salvando a foto 
        if (file_exists($request->file('capa_canal'))) {
            $extension = $request->file('capa_canal')->extension(); //pegando a extension do arquivo
            $nome_foto = uniqid() . '.' . $extension; //dando um nove unico para o arquivo
            $request->file('capa_canal')->storeAs('profile-photos', $nome_foto); //salvando audio na pasta

            $path = 'profile-photos/'.$nome_foto;

            //salvando nome na tabela
            User::where('id', Auth::id())->update(['profile_photo_path' => $path]);
        }

        return back()->with('success', 'Dados atualizados com sucesso');
    }
}
