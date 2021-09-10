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

.id-ep:hover, {
  cursor: pointer;
}

.bx-heart:hover, .bx-add-to-queue:hover{
  color:#eee;
  cursor: pointer;
}

td,  th, tr {
  border: none;
}

.destaque{background:#342C2C;}
</style>
<div class="height-100">
    <div class="row"> 
        <div style="height:280px; width:280px;">
            <img src="{{ asset('storage/'.$data[0]->profile_photo_path) }}" alt="{{ $data[0]->name_podcast }}" class="img-fluid" />
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
                  <th scope="row"><i class="play_audio" audio="{{$ep->name_audio}}" posicao="{{$key+1}}">{{$key+1}}</i></th>
                  <td style="color: #eee;">{{$ep->name_ep}}</td>
                  <td> <i class='bx bx-add-to-queue'></i> <i class='bx bx-heart'></i>  {{$ep->temp_audio}}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
    </div>

{{-- <audio controls muted>
  <source src="http://127.0.0.1:8000/storage/audio_ep/613a140a97fb3.ogg" type="audio/ogg">
</audio> --}}
</div>

<script>
/*
$('.id-ep').on('mouseover', function() {
  $('.bx-play').show();
  $('.id-ep').hide();
});

$('.bx-play').on('mouseout', function() {
  $('.bx-play').hide();
  $('.id-ep').show();
});
*/

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


//add icone   de play
$(function(){
  $('i.play_audio').hover(
    function(){
      $(this).text('');
      $(this).addClass('bx bx-play');
    },
    function(){
      let posicao = $(this).attr('posicao')
      $(this).text(posicao);
      $(this).removeClass('bx bx-play');

    }
  );
});

$("i.play_audio").click(function() {
  const nome_audio = $(this).attr('audio');
  const path_audio = 'http://127.0.0.1:8000/storage/audio_ep/'

  let caminho_completo = path_audio+nome_audio;

  var audio = new Audio(caminho_completo);
  audio.play();
  

  //removendo o numero
  $(this).text('');

  

});
</script>

{{-- quando click do coracao mudar o icon  
 

--}}
