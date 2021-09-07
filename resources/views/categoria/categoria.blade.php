@include('sidebar')

<style>
    .card-categoria{
        padding: 20px;
        border-radius: 3px;
        height: 330px;
        color: #fff;
        background-color: #181818;
        /*border: 1px solid #c5c5c5;*/
    }

    .card-categoria:hover{
        background-color: #222222;
    }

    .name-user{
        text-align: center;
        color: #9c9c9c;
    }

    .titulo-categoria{
        font-size:1.5rem;
        font-weight:bold;
        text-align:center;
        color: #fff;
    }

    .icon_voltar{
        border-radius: 100%;
        background-color: #181818;
        height: 30px;
        width: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .icon_voltar:hover{
        background-color: #222222;
        cursor: pointer;
    }

    .img-fluid{
        max-height: 210px;
    }
</style>

<div class="height-100">
    <div style="padding-top:30px;" class="row"> 
        <div class="col-md-3">
            <div class="row"> 
                <a href="{{route('index_categoria')}}" class="icon_voltar col-6"><i class='bx bx-chevron-left nav_icon'></i> </a>
                <span class="tiulo col-6">{{$categoria[0]->type}}</span>
            </div>
        </div> 
        <div class="col-md-9">

        </div>
    </div>
    <div class="row" style="margin-top:10px;">
        @foreach ($podcast as $pod)
            <div class="col-md-3 " style="margin-bottom:20px;">
                <a href="">
                    <div class="card-categoria">
                        <div class="row"> 
                            <p class="titulo-categoria">{{$pod->name_podcast}}</p>
                            <p class="name-user"> <span>@</span>{{$pod->name}}</p>
                        </div>
                        <div class="row"style="margin-top:10px;">
                            <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="img-fluid" />
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>

<script> 
    $(".titulo-categoria").text(function(){
        return $(this).text().length > 15 ? $(this).text().substr(0, 15)+'...' : $(this).text();
    });
</script>

