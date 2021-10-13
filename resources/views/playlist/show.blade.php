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
    background:#262626;
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
</style>

<div class="height-100">
  <div class="add-alert"></div>

  <!-- Modal mudar nome playlist-->
  <div class="modal fade" id="renome_playlist" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Trocar nome {{$nomePlaylist[0]->nome}}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="post" action="{{ route('renome_playlist') }}">
            @csrf
            <input type="hidden" value="{{$id_playlist}}" name="id_playlist">
            <div class="row">
              <div class="col-md-12">
                <div class="form-floating mb-3">
                  <input type="text" class="form-control form-perfil" placeholder="Leave a comment here" id="floatingInput" name="novo_nome">
                  <label for="floatingInput" class="label-perfil">Novo nome</label>
                </div>
              </div>

              <div class="col-md-12">
                <button class="btn btn-enviar" type="submit" style="float:right;margin-bottom:20px"> Salvar </button>
              </div>
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

    <div class="row">
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
                <i class='bx bx-trash-alt' id-ep="{{$ep->id}}" id-playlist="{{$id_playlist}}"></i>
                {{$ep->temp_audio}}
              </td>
            </tr>
          @endforeach 
        </tbody>
      </table>
    </div>
</div>

<script>
  //remove alert
  setTimeout(function(){ 
    $('.div-alert').remove();   
  }, 6000);

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
    
    document.getElementById('demo'+id).play();
    $(this).hide();
    $('#pause'+id).show();
  });

  //pause o audio que esta tocando para que o outro possar dar o play e tomar sozinho, reinicia o time do algo anterior
  document.addEventListener('play', function(e){
    var audios = document.getElementsByTagName('audio');
    for(var i = 0, len = audios.length; i < len;i++){
      if(audios[i] != e.target){
        var id = audios[i].id
        var id = id.replace(/[^0-9]/g,'');

        $('#pause'+id).hide();
        $('#play'+id).show();

        audios[i].pause();
        audios[i].currentTime = 0
      }
    }
  }, true);

  //pause audio
  $("[id^=pause]").click(function() {
    const id = this.id.slice(5);
    document.getElementById('demo'+id).pause();
    $(this).hide();
    $('#play'+id).show();
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
      }
    });
  });

</script>