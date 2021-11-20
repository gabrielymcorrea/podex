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

    .form-audio {
        background-color: #222222;
        color: #eee;
        border: 7px solid #222222;
    }

    input:focus,
    input:active,
    textarea:focus,
    textarea:active,
    select:focus,
    select:active  {
        background-color: #222222 !important;
        color: #fff !important;
        box-shadow: none !important;
    }

    input:-webkit-autofill,
    input:-webkit-autofill:hover,
    input:-webkit-autofill:focus,
    textarea:-webkit-autofill,
    textarea:-webkit-autofill:hover textarea:-webkit-autofill:focus,
    select:-webkit-autofill,
    select:-webkit-autofill:hover,
    select:-webkit-autofill:focus {
        -webkit-text-fill-color: #fff !important;
        -webkit-box-shadow: 0 0 0px 1000px #222222 inset !important;
    }

    .upload-btn-wrapper {
        position: relative;
        overflow: hidden;
        display: inline-block;
    }

    .btn-file {
        color: #eee;
        background-color: #6D60E0;
        padding: 8px 20px;
        border-radius: 8px;
        font-size: 20px;
        font-weight: bold;
        border:none;
    }

    .btn-file:hover{
        cursor: pointer !important;
        background-color: #6d60e085 !important;
    }
  
    .upload-btn-wrapper input[type=file] {
        font-size: 100px;
        position: absolute;
        left: 0;
        top: 0;
        opacity: 0;
    }

    @media(max-width:750px){
        .upload-btn-wrapper {
            float: right;
        }
    }

    img {
        height:280px !important;
        object-fit: cover;
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

    @if (\Session::has('success'))
        <div class="alert alert-primary" role="alert">
            {!! \Session::get('success') !!}
        </div>
    @endif

    <div style="padding-top:30px;" class="row">
        <div class="col-md-12">
            <p class="tiulo"> Informações da conta</p>
        </div>
    </div>

    <div class="row" style="margin-top: 10px;">
        <form method="post" action="{{ route('canal') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">  
                <div style="height:300px; width:300px;">
                    @if ($user[0]->profile_photo_path)
                        <img src="{{ asset('storage/' . $user[0]->profile_photo_path) }}" alt="{{ $user[0]->name_podcast }}" class="img-fluid" id="mostraFoto" />
                    @else
                        <img src="{{ asset('semimage.png') }}" alt="podex" class="img-fluid" id="mostraFoto"/>
                    @endif
                    <p class="frase_salvarImg" style="display: none; font-weight:bold;color: #4723d9;">Clique em SALVAR *</p>
                </div>
                
                <div class="col-md-6 mt-3">
                    <div class="upload-btn-wrapper">
                        <button class="btn-file"><i class='bx bx-upload' ></i></button>
                        <input type="file" name="capa_canal" onchange="loadFile(event)" accept="image/*"/>
                    </div>
                </div>
            </div>

            <hr style="color: #3c3a3a;">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control form-perfil" placeholder="Leave a comment here"
                            id="floatingInput" name="name" value="{{ isset($user[0]->name) ? $user[0]->name : '' }}" required>
                        <label for="floatingInput" class="label-perfil">Nome usuario</label>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control form-perfil" placeholder="Leave a comment here"
                            id="floatingInput" name="email"
                            value="{{ isset($user[0]->email) ? $user[0]->email : '' }}" required>
                        <label for="floatingInput" class="label-perfil">Email</label>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control form-perfil" placeholder="Leave a comment here"
                            id="NovaSenha" name="nova_senha" value="********">
                        <label for="NovaSenha" class="label-perfil">Senha</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control form-perfil" placeholder="Leave a comment here"
                            id="floatingInput" name="name_podcast"
                            value="{{ isset($user[0]->name_podcast) ? $user[0]->name_podcast : '' }}">
                        <label for="floatingInput" class="label-perfil">Nome canal</label>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <select class="form-select form-perfil" name="categoria" id="floatingSelect"
                            aria-label="Floating label select example">
                            <option value="">Escolha</option>
                            @foreach ($categorias as $cat)
                                <option @if ($cat->id == $user[0]->id_categoria) selected @endif value="{{ $cat->id }}">{{ $cat->type }}
                                </option>
                            @endforeach
                        </select>
                        <label for="floatingSelect" class="label-perfil">Categoria</label>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-floating mb-3">
                    <textarea class="form-control form-perfil" style="resize: none; height: 120px" maxlength="255"
                        placeholder="Leave a comment here" name="descricao"
                        id="descricao">{{ isset($user[0]->descricao) ? $user[0]->descricao : '' }}</textarea>
                    <label for="floatingTextarea2" class="label-perfil">Descrição</label>
                </div>
            </div>


            <div class="col-md-12">
                <button class="btn btn-enviar" type="submit" style="float:right;margin-bottom:20px"> Salvar </button>
            </div>
        </form>
    </div>
</div>

<script>
    var loadFile = function(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('mostraFoto');
            output.src = reader.result;

            $('.frase_salvarImg').show();
        };
        reader.readAsDataURL(event.target.files[0]);
    };

    $("#NovaSenha").click(function() {
        $(this).val('');
    });

    $(document).ready(function(){			
        setTimeout(function() {
        $(".alert").fadeOut("slow", function(){
            $(this).alert('close');
        });				
        }, 5000);			
    });
</script>
