@section('title', 'Playlist')
@include('sidebar')

<style>
    td, th, tr {
        border: none;
    }

    a{
      display: inline-block;
      padding:0px ;
      color: #56545a;
    }

    .bx-trash-alt:hover, .bxs-log-in:hover, a:hover{
        color:#eee;
        cursor: pointer;
    }

    td:hover, tr:hover,h1:hover, p:hover{
      cursor: default;
    }
</style>

<div class="height-100">
    <div class="add-alert"></div>
    
    <div class="row"> 
        <h1 style="font-weight:bold;">Minhas playlist</h1>
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
            @foreach ($playlists as $playlist)
                <tr id="{{$playlist->id}}">
                    <td scope="row">{{$playlist->id}}</td>
                    <td scope="row"><a href="{{route('show_playlist', $playlist->id)}}"> {{$playlist->nome}} </a></td>
                    <td scope="row">
                      <i class='bx bx-trash-alt' id-playlist="{{$playlist->id}}" data-bs-toggle="tooltip" data-bs-placement="right" title="Deletar"></i></a> 
                      <a href="{{route('show_playlist', $playlist->id)}}" data-bs-toggle="tooltip" data-bs-placement="right" title="Ir playlist"><i class='bx bxs-log-in'></i></a>
                    </td>
                </tr>    
            @endforeach
          </tbody>
        </table>
      </div>
</div>

<script>
 //delete a playlist
  $("i.bx-trash-alt").click(function() {
    var id_playlist = $(this).attr('id-playlist');

    var dados = {
      'id_playlist': id_playlist,
    };

    $.ajax({
      url: "/delete_playlist",
      headers:{
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: 'POST',
      data: dados,
      dataType: 'json',
      success: function(data) {
        $(".div-alert").remove();
        var frase = 'Playlist deletada';
        $(".add-alert").append(`<div class="div-alert"> <p> ${frase} </p> </div>`);
        $('#'+id_playlist).hide();

        //remove alert
        setTimeout(function() {
          $('.div-alert').remove();
        }, 4000);
      }
    });
  });

</script>