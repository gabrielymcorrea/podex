@section('title', 'Categoria')
@include('sidebar')

<style>
    .card-categoria {
        padding: 20px;
        border-radius: 3px;
        height: 330px;
        background-color: #181818;
        /*border: 1px solid #c5c5c5;*/
    }

    .card-categoria:hover {
        background-color: #222222;
    }

    .tituloo-categoria {
        font-size: 1.5rem;
        font-weight: bold;
        text-align: center;
        margin-bottom: 20px;
        color: #fff;
    }

    img {
        filter: brightness(50%);
    }

    @media(max-width: 555px){
        .img-fluid {
            max-width: 70%;
        }
        .div-categoria{
            text-align: center;
        }
    }

</style>

<div class="height-100">
    <div style="padding-top:30px;" class="row">
        <div class="col-md-3">
            <p class="tiulo"> Categoria </p>
        </div>
    </div>
    <div class="row scrolling-pagination" style="margin-top:10px;">
        @foreach ($categorias as $cat)
            <div class="col-md-3 col-xs-6 col-sm-6 div-categoria" style="margin-bottom:20px;">
                <a href="{{ route('categoria', $cat->id) }}">
                    <div class="card-categoria">
                        <p class="tituloo-categoria">{{ $cat->type }}</p>
                        <img src="{{ asset('image_categoria/' . $cat->id . '.png') }}" class="img-fluid"
                            alt="{{ $cat->type }}" />
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>
