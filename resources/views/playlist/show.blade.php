@section('title', 'Playlist')
@include('sidebar')

<style>
  .nav-link{
    display: inline-block;
    padding:0px ;
  }

  .bx-add-to-queue:hover, .bx-trash-alt:hover, .bxs-edit:hover, .bx-play:hover , .bx-pause:hover{
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

  .modal-content {
    background-color:#121212;
  }

  .modal-header{
    border-bottom: 1px solid #342C2C;
  }

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

  
  .btn-close:focus, .btn:focus {
    box-shadow: none;
  }

  .form-perfil {
    color: #fff;
    background-color: #181818;
    border: none;
    border-radius: 0;
  }

  .form-perfil,
  .form-perfil:hover,
  .form-perfil:focus,
  .form-perfil:active {
    color: #fff;
    -webkit-text-fill-color: #8f8d8d ;
    -webkit-box-shadow: 0 0 0px 1000px #222222 inset;
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

  <!-- Modal mudar nome playlist-->
  <div class="modal fade" id="renome_playlist" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Trocar nome</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="post" action="{{ route('renome_playlist') }}">
            @csrf
            <input type="hidden" value="{{$id_playlist}}" name="id_playlist">
            <div style="display: flex;">
              <input type="hidden" id="id_ep" name="id_ep"/>
              <input type="text" placeholder="Novo nome" name="novo_nome" class="form-control form-perfil" />
              <button type="submit" class="btn" style="color: #eee;border-radius: 0; background:#222222"> <i class='bx bx-send' data-bs-toggle="tooltip" data-bs-placement="right" title="Enviar alterações"></i> </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="row"> 
      <div style="height:280px; width:280px;">
          <img src="../playlist.png" alt="playlist" class="img-fluid" />
      </div>
      <div class="col-md-6" style="margin-top: 30px"> 
          <h1 style="font-weight:bold;">{{$nomePlaylist[0]->nome}} <i class='bx bxs-edit' data-bs-toggle="modal" data-bs-target="#renome_playlist"></i></h1>
          <p> {{Auth::user()->name }} </p>
      </div>
  </div>

  <div class="row" style="padding-bottom: 100px;">
    <table class="table" id="ep">
      <thead style="border-bottom: 1px solid #342C2C;">
        <tr style="color: #56545a;">
          <th scope="col" style="width: 30px">#</th>
          <th scope="col" >Nome</th>
          <th scope="col" style="width: 200px"></th>
        </tr>
      </thead>
      <tbody style="color: #56545a;">
        @foreach ($playlist as $key => $ep)
          <tr id="{{$ep->id }}">
            <td scope="row" style="width: 40px">
              <i class="bx bx-play" id="play{{$key}}"></i> 
              <i class='bx bx-pause' id="pause{{$key}}" style="display: none;"></i>
              <audio controls id="demo{{$key}}" src="http://127.0.0.1:8000/storage/audio_ep/{{$ep->name_audio}}" style="display: none;"></audio>
            </td>
            <td style="color: #eee;">{{$ep->name_ep}}</td>
            <td style="width: 200px"> 
              <img src="{{ asset('sound.gif') }}" alt="gif som" class="gif_som" id="gif_som{{$key}}"/>
              <i class='bx bx-trash-alt' id-ep="{{$ep->id}}" id-playlist="{{$id_playlist}}" data-bs-toggle="tooltip" data-bs-placement="right" title="Deletar"></i>
              {{$ep->temp_audio}}
            </td>
          </tr>
        @endforeach 
      </tbody>
    </table>
  </div>

  <div id="wrapper" style="display: none;">
    <audio preload="auto" controls id="play-footer">
      <source src="" id="oggSource">
    </audio>
  </div>
</div>


<script src="{{ asset('js/audioplayer.js') }}"></script>
<script>
  //remove alert
  setTimeout(function(){ 
    $('.div-alert').remove();   
  }, 4000);

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
   
   
    if(audioTocando != novoAudio){
      $('[id^=pause]').hide();
      $('[id^=play]').show();
      $('[id^=gif_som]').css('opacity',0);

      $('#wrapper').empty();
      $('#wrapper').append('<audio preload="auto" controls id="play-footer"> <source src="" id="oggSource"></audio>');
     
      var audio = document.getElementById('oggSource');
      audio.src = novoAudio;

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

  //remove ep da playlist
  $("i.bx-trash-alt").click(function() {
    var id_ep = $(this).attr('id-ep');
    var id_playlist = $(this).attr('id-playlist');

    var dados = {
      'id_ep': id_ep,
      'id_playlist': id_playlist
    };

    $.ajax({
      url: "/remove_ep_playlist",
      headers:{
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: 'POST',
      data: dados,
      dataType: 'json',
      success: function(data) {
        $(".div-alert").remove();
        var frase = 'Removido da playlist';
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