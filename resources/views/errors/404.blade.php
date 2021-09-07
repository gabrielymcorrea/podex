@include('app')

<style> 
    .text-error{
        font-size: 3rem; 
        font-weight: bold;
    }

    .subtitulo-error{
        font-size: 1.5rem;
    }

    .btn-error{
        background: #6D60E0;
        color: #fff;
        width: 200px;
    }

    .btn-error:hover{
        background: #6d60e085;
        color: #FFFFFF;
    }

    .img-fluid{
        max-width:95%;
    }

    @media(max-width:765px){
        .col-md-3{
            margin-top: 65px;
            text-align: center;
            margin-bottom:20px;
        }
    }

</style>

<div class="row pagina-error">
    <div class="col-md-7"><img src="{{asset('pagerro2.png')}}" class="img-fluid" alt="paginaErro" /></div>
    <div class="col-md-3"> 
        <p class="text-error">Opss!</p> 
        <p class="subtitulo-error"> Algo saiu errado... </p> 
        <button class="btn btn-error"> Voltar</button>
    </div>
    
</div>

<script>
  $('.btn-error').click(function(){
    history.go(-1)
  });
</script>