@section('title', 'Playlist')
@include('sidebar')

<style>
  .nav-link{
    display: inline-block;
    padding:0px ;
  }

  .bx-add-to-queue:hover, .bx-trash-alt:hover {
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
    background:#342C2C;
  }

  .add_playlist:hover{
    cursor: pointer;
  }
</style>

<div class="height-100">
    <div class="row"> 
        <h1 style="font-weight:bold;">{{$playlist[0]->nome}}</h1>
    </div>

    <div class="row">
        <table class="table" id="ep">
          <thead style="border-bottom: 1px solid #342C2C;">
            <tr style="color: #56545a;">
              <th scope="col">#</th>
              <th scope="col" >Nome</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody style="color: #56545a;">
            @foreach ($playlists as $key => $ep)
              <tr>
                <th scope="row">
                  <i class="bx bx-play" id="play{{$key}}"></i> 
                  <i class='bx bx-pause' id="pause{{$key}}" style="display: none;"></i>
                  <audio controls id="demo{{$key}}" src="http://127.0.0.1:8000/storage/audio_ep/{{$ep->name_audio}}" style="display: none;"></audio>
                </th>
                <td style="color: #eee;">{{$ep->name_ep}}</td>
                <td> 
                  <i class='bx bx-trash-alt' id-ep="{{$ep->id}}"></i>
                  {{$ep->temp_audio}}
                </td>
              </tr>
            @endforeach 
          </tbody>
        </table>
      </div>
</div>

<script>
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

  //remove na playlist
  $("i.bx-trash-alt").click(function() {
    
  });
</script>