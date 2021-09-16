@section('title', $data[0]->name_podcast)
@include('sidebar')

<style>
  .podcast_por{
    color:#eee ;
    font-size:1.3rem;
  }

  .podcast_por:hover {
    color:#4723D9;
    text-decoration:underline !important;
  }

  .id-ep:hover, .add_playlist:hover{
    cursor: pointer;
  }

  .bx-heart:hover, .bx-add-to-queue:hover, .bxs-heart:hover, .bx-pause:hover, .bx-play:hover{
    color:#eee;
    cursor: pointer;
  }
  
  td, th, tr {
    border: none;
  }

  .bx-add-to-queue{
    color:#56545a;
  }

  .nav-link{
    display: inline-block;
    padding:0px ;
  }

  .destaque{
    background:#342C2C;
  }
</style>

<div class="height-100">
    <div class="row"> 
        <div style="height:280px; width:280px;">
          @if ($data[0]->profile_photo_path)
            <img src="{{ asset('storage/'.$data[0]->profile_photo_path) }}" alt="{{ $data[0]->name_podcast }}" class="img-fluid" />
          @else
            <img src="{{ asset('semimage.png') }}" alt="podex" class="img-fluid" />
          @endif
        </div>
        <div class="col-md-6"> 
            <h1 style="font-weight:bold;"> {{isset($data[0]->name_podcast) ? $data[0]->name_podcast : ''}}</h1>
            <a href="" class="podcast_por">Por {{isset($data[0]->name) ? $data[0]->name : ''}}</a>
            <p style="margin-top:10px;color: #bbb;">{{isset($data[0]->descricao) ? $data[0]->descricao : ''}}</p>
        </div>
    </div>

    <div class="row">
      <table class="table" id="ep">
        <thead style="border-bottom: 1px solid #342C2C;">
          <tr style="color: #56545a;">
            <th scope="col">#</th>
            <th scope="col" >Título</th>
            <th scope="col"><i class='bx bx-time'></i></th>
          </tr>
        </thead>
        <tbody style="color: #56545a;">
          @foreach ($eps as $key => $ep)
            <tr>
              <th scope="row">
                <i class="bx bx-play" id="play{{$key}}"></i> 
                <i class='bx bx-pause' id="pause{{$key}}" style="display: none;"></i>
                <audio controls id="demo{{$key}}" src="http://127.0.0.1:8000/storage/audio_ep/{{$ep->name_audio}}" style="display: none;"></audio>
              </th>
              <td style="color: #eee;">{{$ep->name_ep}}</td>
              <td> 
                <a class="nav-link dropdown logado" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class='bx bx-add-to-queue'></i>       
                </a>
                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                  @if(count($playlist) <= 5 )
                    <li><a class="dropdown-item add_playlist" id-ep="{{$ep->id}}" id-playlist="0">Nova playlist</a></li>
                  @endif
                  @foreach ($playlist as $play)
                    <li><a class="dropdown-item add_playlist" id-playlist="{{$play->id}}" id-ep="{{$ep->id}}">{{$play->nome}}</a></li>
                  @endforeach
                </ul>
                
                <i id-ep="{{$ep->id}}" 
                  @if (count($curtidas) != 0)
                    @foreach ($curtidas as $cut)
                      @if($cut->id_ep == $ep->id)
                        class='bx bxs-heart'
                      @else
                        class='bx bx-heart'
                      @endif
                    @endforeach
                  @else
                    class='bx bx-heart'
                  @endif >
                </i> {{$ep->temp_audio}}
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
  $('table#ep tbody tr').hover(
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

//salvar status da curtida, curtir
$("i.bx-heart").click(function() {
  var id_ep = $(this).attr('id-ep')
  var acao = $(this)[0];

  var dar_like = document.querySelector("i.bx-heart");
  var tirar_like = document.querySelector("i.bxs-heart");
  $(this).toggleClass("bxs-heart bx-heart"); 

  if(acao == dar_like){
    var dados = {
      'acao': 1,
      'id_ep': id_ep,
    };
  }

  if(acao == tirar_like){
    var dados = {
      'acao': 2,
      'id_ep': id_ep,
    };
  }

  $.ajax({
    url: "/curtida",
    headers:{
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    type: 'POST',
    data: dados,
    dataType: 'json',
    success: function(data) {
      console.log(data)
    }
  });
});

//salvar status da curtida, tirar curtidaa
$("i.bxs-heart").click(function() {
  var id_ep = $(this).attr('id-ep')
  var acao = $(this)[0];

  var dar_like = document.querySelector("i.bx-heart");
  var tirar_like = document.querySelector("i.bxs-heart");
  $(this).toggleClass("bxs-heart bx-heart"); 

  if(acao == dar_like){
    var dados = {
      'acao': 1,
      'id_ep': id_ep,
    };
  }

  if(acao == tirar_like){
    var dados = {
      'acao': 2,
      'id_ep': id_ep,
    };
  }

  $.ajax({
    url: "/curtida",
    headers:{
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    type: 'POST',
    data: dados,
    dataType: 'json',
    success: function(data) {
      //console.log(data)
    }
  });
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
      //console.log(data)
    }
  });
});
</script>
