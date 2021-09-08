@include('sidebar')


<style>
    .form-perfil {
        color: #fff;
        background-color: #222222;
        border: none;
    }

    .label-perfil {
        color: #fff;
    }


    .form-floating>label {
        color: #fff;
    }

    input:focus,
    input:active,
    textarea:focus,
    textarea:active {
        background-color: #222222 !important;
        color: #fff !important;
    }

</style>

<div class="height-100">
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div style="padding-top:30px;" class="row">
        <div class="col-md-12">
            <p class="tiulo"> Canal podcast</p>
        </div>
    </div>

    <div class="row">
        <p style="color: #bbb;"> Informações do canal </p>
        <form method="post" action="{{route('canal')}}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control form-perfil" placeholder="Leave a comment here" id="floatingInput" name="name_podcast" value="{{isset($user[0]->name_podcast) ? $user[0]->name_podcast : ''}}">
                        <label for="floatingInput" class="label-perfil">Nome canal</label>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <select class="form-select form-perfil" name="categoria" id="floatingSelect" aria-label="Floating label select example">
                            <option selected>Escolha</option>
                            @foreach ($categorias as $cat)
                            <option @if($cat->id == $user[0]->id_categoria) selected @endif value="{{$cat->id}}">{{$cat->type}}</option>
                            @endforeach
                        </select>
                        <label for="floatingSelect" class="label-perfil">Categoria</label>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-floating mb-3">
                    <textarea class="form-control form-perfil" style="resize: none; height: 120px" maxlength="255" placeholder="Leave a comment here" name="descricao" id="descricao">{{isset($user[0]->descricao) ? $user[0]->descricao : ''}}</textarea>
                    <label for="floatingTextarea2" class="label-perfil">Descrição</label>
                </div>
            </div>

            <div class="col-md-12" >
                <button class="btn btn-enviar" type="submit" style="float:right;"> Salvar </button>
            </div>
        </form>
    </div>

    <hr style="color: #4a4545;">
    <div class="row">
        <p style="color: #bbb;"> Poste novos episódios </p>
        <form method="post" action="{{route('episodio')}}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control form-perfil" id="nome_podcast" name="nome_ep" placeholder="Leave a comment here">
                        <label for="nome_podcast" class="label-perfil">Nome ep</label>
                    </div>
                </div>

            </div>

            <input type="file" class="form-control mb-3" accept="audio/*" name="audio_ep">

            <input type="file" class="form-control mb-3" accept="image/*" name="image_capa">

            <button type="submit" class="btn btn-primary"> enviar </button>
        </form>
    </div>

</div>
{{-- <audio controls muted>
            <source src="{{asset('storage/audio_ep/'.$podcast[0]->name_audio)}}" type="audio/ogg">

var audio = new Audio('audio_file.mp3');
audio.play();
</audio> --}}
