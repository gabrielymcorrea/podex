@section('title', 'Curtida')
@extends('app')

@section('content')

<style>
  .nav-link{
    display: inline-block;
    padding:0px ;
  }

  .bx-add-to-queue:hover, .bx-trash-alt:hover, .bx-pause:hover, .bx-play:hover {
    color:#eee;
    cursor: pointer;
  }

  td, th, tr {
    border: none;
  }

  .bx-add-to-queue{
    color:#56545a;
  }

  .destaque{
    background:#222121;
  }

  .add_playlist:hover{
    cursor: pointer;
  }

  td:hover, tr:hover,h1:hover, p:hover{
    cursor: default;
  }

  .alert-js{
    height: 25px;
    background-color: #fff;
    color: #000;
    position: absolute;
    left: 50%;
    width: 25px;
    bottom: 100px;
  }

  .gif_som{
    height:15px;
    opacity: 0;
    margin-bottom: 8px;
  }

  #wrapper { 
    margin: 150px auto; 
    max-width: 100%; 
  }
</style>

<div class="height-100">
    <div class="add-alert"></div>

    <div class="row"> 
        <div style="height:280px; width:280px;">
            <img src="curtida.png" alt="curtida" class="img-fluid" />
        </div>
        <div class="col-md-6" style="margin-top: 30px"> 
            <h1 style="font-weight:bold;"> Minhas curtidas</h1>
            <p> {{Auth::user()->name }} </p>
            <p> {{count($curtidas)}} curtida <i class='bx bxs-like'></i> </p> 
        </div>
    </div>

    <div class="row" style="padding-bottom: 100px;">
        <table class="table" id="curtida">
          <thead style="border-bottom: 1px solid #342C2C;">
            <tr style="color: #56545a;">
              <th scope="col" style="width: 30px">#</th>
              <th scope="col" >Título</th>
              <th scope="col" style="width: 200px"></i></th>
            </tr>
          </thead>
          <tbody style="color: #56545a;">
            @foreach ($curtidas as $key => $ep)
              <tr id="{{$ep->id}}">
                <th scope="row" class="icon-play-pause">
                  <i class="bx bx-play" id="play{{$key}}"></i> 
                  <i class='bx bx-pause' id="pause{{$key}}" style="display: none;"></i>
                  <audio controls id="demo{{$key}}" class="percorrer_id" src="http://127.0.0.1:8000/storage/audio_ep/{{$ep->name_audio}}" style="display: none;"></audio>
                </th>
                <td style="color: #eee;">{{$ep->name_ep}}</td>
                <td> 
                  <i class='bx bx-trash-alt' id="deletar{{$key}}" id-ep="{{$ep->id}}" data-bs-toggle="tooltip" data-bs-placement="right" title="Deletar"></i>
                  <a class="nav-link dropdown logado" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class='bx bx-add-to-queue' data-bs-toggle="tooltip" data-bs-placement="right" title="Adicionar playlist"></i>       
                  </a>
                  <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                    @if(count($playlist) <= 5 )
                      <li><a class="dropdown-item add_playlist" id-ep="{{$ep->id}}" id-playlist="0">Nova playlist</a></li>
                    @endif
                    @foreach ($playlist as $play)
                      <li><a class="dropdown-item add_playlist" id-playlist="{{$play->id}}" id-ep="{{$ep->id}}">{{$play->nome}}</a></li>
                    @endforeach
                  </ul>
                   {{$ep->temp_audio}}
                   <img src="{{ asset('sound.gif') }}" alt="gif som" class="gif_som" id="gif_som{{$key}}"/>
                </td>
              </tr>
            @endforeach 
          </tbody>
        </table>
    </div>

    <div id="wrapper" style="display: none;">
      <audio preload="none" controls id="play-footer">
        <source src="" id="oggSource">
      </audio>
    </div>
</div>

<script>
  //remove alert
  setTimeout(function(){ 
    $('.div-alert').remove();   
  }, 5000);

  //linha cinza hover 
  $(function(){
    $('table#curtida tbody tr').hover(
      function(){
        $(this).addClass('destaque');
      },
      function(){
        $(this).removeClass('destaque');

      }
    );
  });

  //play audio
  $("[id^=play]").click(function(event) {
    const id = this.id.slice(4);
    
    var audioTocando = document.getElementById('oggSource').src;
    var novoAudio = document.getElementById('demo'+id).src;

    $('[id^=deletar]').css('opacity',1);
    $('#deletar'+id).css('opacity',0);
   
    if(audioTocando != novoAudio){
      $('[id^=pause]').hide();
      $('[id^=play]').show();
      $('[id^=gif_som]').css('opacity',0);

      $('#wrapper').empty();
      $('#wrapper').append('<audio preload="none" controls id="play-footer"> <source src="" id="oggSource"></audio>');
     
      var audio = document.getElementById('oggSource');
      audio.src = novoAudio;

      $('#play-footer').trigger('load');
      $('#play-footer').audioPlayer();
    }
    if($('#wrapper').is(':hidden')){
      $('#wrapper').show();
    }

    $(this).hide();
    $('#pause'+id).show();
    $('#pause'+id).addClass("aqui");
    $('#gif_som' +id).css('opacity',1);
    $('.audioplayer-playpause a').click();
    
  });

  //pause audio
  $("[id^=pause]").click(function() {
    const id = this.id.slice(5);
    $(this).hide();
    $('#play'+id).show();

    $('.audioplayer-playpause a').click();
    $('#pause'+id).removeClass("aqui");
    $('#gif_som' +id).css('opacity',0);
  });

  //add na playlist
  $("a.add_playlist").click(function() {
    var id_playlist = $(this).attr('id-playlist');
    var id_ep = $(this).attr('id-ep');

    var dados = {
      'id_playlist': id_playlist,
      'id_ep': id_ep,
    };

    $.ajax({
      url: "/add_playlist",
      headers:{
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: 'POST',
      data: dados,
      dataType: 'json',
      success: function(data) {
        $(".div-alert").remove();
        var frase = 'Adicionado na playlist';
        $(".add-alert").append(`<div class="div-alert"> <p> ${frase} </p> </div>`);

        //remove alert
        setTimeout(function() {
          $('.div-alert').remove();
        }, 4000);
      }
    });
  });

  //tirar curtida
  $('i.bx-trash-alt').click(function(){
    var id_ep = $(this).attr('id-ep');

    var dados = {
      'acao': 2,
      'id_ep': id_ep,
    };

    $.ajax({
      url: "/curtida",
      headers:{
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: 'POST',
      data: dados,
      dataType: 'json',
      success: function(data) {
        $(".div-alert").remove();
        var frase = 'Curtida removida';
        $(".add-alert").append(`<div class="div-alert"> <p> ${frase} </p> </div>`);
        $('#'+id_ep).hide();

        //remove alert
        setTimeout(function() {
          $('.div-alert').remove();
        }, 4000);
      }
    });
  });

</script>

@endsection