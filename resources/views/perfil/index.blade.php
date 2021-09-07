@include('sidebar')


<style> 
    .form-perfil {
        color: #fff;
        background-color: #222222;
        border: none;
    }

    .label-perfil{
        color: #fff;
    }

    .input-wrapper input:focus, .input-wrapper input:active{
        background-color: #222222;
        border: 1px solid #333;
        color: #fff;
    }
    .form-floating>label{
        color:#fff;
    }
</style>
<div class="height-100">
    <div style="padding-top:30px;" class="row">
        <div class="col-md-12">
            <p class="tiulo"> Canal podcast</p>
        </div>
    </div>

    <div class="row">
        <form method="post">
            <div class="form-floating mb-3">
                <input type="email" class="form-control form-perfil " id="nome_podcast" value="{{isset($user[0]->name_podcast) ? $user[0]->name_podcast : ''}}">
                <label for="floatingInput" class="label-perfil">Nome canal</label>
            </div>

            <div class="form-floating">
                <select class="form-select form-perfil " id="floatingSelect" aria-label="Floating label select example">
                    <option selected>Escolha</option>
                    @foreach ($categorias as $cat)
                    <option @if($cat->id == $user[0]->id_categoria) selected @endif value="{{$cat->id}}">{{$cat->type}}</option>
                    @endforeach
                </select>
                <label for="floatingSelect" class="label-perfil">Categoria</label>
            </div>

            <div class="form-floating">
                <textarea class="form-control form-perfil" style="resize: none; height: 120px" placeholder="Leave a comment here" id="descricao" max="255">{{isset($user[0]->decricao) ? $user[0]->decricao : ''}}</textarea>
                <label for="floatingTextarea2" class="label-perfil">Descrição</label>
            </div>

        </form>
    </div>

</div>
