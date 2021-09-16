@section('title', 'Playlist')
@include('sidebar')

<style>
    td, th, tr {
        border: none;
    }

    .bx-trash-alt:hover, .bxs-log-in:hover{
        color:#eee;
        cursor: pointer;
    }
</style>

<div class="height-100">
    <div class="row"> 
        <div style="height:280px; width:280px;">
            <img src="playlist.png" alt="curtida" class="img-fluid" />
        </div>
        <div class="col-md-6" style="margin-top: 30px"> 
            <h1 style="font-weight:bold;"> Minhas playlist</h1>
            <p> {{Auth::user()->name }} </p>
        </div>
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
            @foreach ($playlists as $playlist)
                <tr>
                    <td scope="row">{{$playlist->id}}</td>
                    <td scope="row"><a href="{{route('show_playlist', $playlist->id)}}"> {{$playlist->nome}} </a></td>
                    <td scope="row">
                      <a href="{{route('delete_playlist', $playlist->id)}}"><i class='bx bx-trash-alt'></i></a> 
                      <a href="{{route('show_playlist', $playlist->id)}}"><i class='bx bxs-log-in'></i></a>
                    </td>
                </tr>    
            @endforeach
          </tbody>
        </table>
      </div>
</div>
