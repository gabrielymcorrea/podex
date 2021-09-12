@section('title', 'Perfil')
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

    .form-audio{
        background-color: #222222;
        color: #eee;
        border: 1px solid #222222;
    }

    input:focus,
    input:active,
    textarea:focus,
    textarea:active {
        background-color: #222222 !important;
        color: #fff !important;
        box-shadow: none !important;
    }

    input:-webkit-autofill,
    input:-webkit-autofill:hover, 
    input:-webkit-autofill:focus,
    textarea:-webkit-autofill,
    textarea:-webkit-autofill:hover
    textarea:-webkit-autofill:focus,
    select:-webkit-autofill,
    select:-webkit-autofill:hover,
    select:-webkit-autofill:focus {
        -webkit-text-fill-color: #fff !important;
        -webkit-box-shadow: 0 0 0px 1000px #222222 inset !important;
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
            <p class="tiulo"> Poste novos episódios</p>
        </div>
    </div>
    
    <div class="row">
        <form method="post" action="{{route('episodio')}}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control form-perfil" id="nome_podcast" name="nome_ep" placeholder="Leave a comment here">
                        <label for="nome_podcast" class="label-perfil">Nome ep</label>
                    </div>
                </div>

            </div>

            <input type="file" class="form-control mb-3 form-audio" accept="audio/*" name="audio_ep">

            <div class="col-md-12" >
                <button class="btn btn-enviar" type="submit" style="float:right;"> Enviar </button>
            </div>
        </form>
    </div>

</div>
{{-- <audio controls muted>
            <source src="{{asset('storage/audio_ep/'.$podcast[0]->name_audio)}}" type="audio/ogg">

var audio = new Audio('audio_file.mp3');
audio.play();
</audio> --}}
