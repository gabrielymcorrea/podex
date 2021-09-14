@section('title', 'Playlist')
@include('sidebar')

<style>
    td, th, tr {
        border: none;
    }
</style>

<div class="height-100">
    <div class="row"> 
        <div style="height:280px; width:280px;">
            <img src="playlist.png" alt="curtida" class="img-fluid" />
        </div>
        <div class="col-md-6" style="margin-top: 30px"> 
            <h1 style="font-weight:bold;">{{$playlist[0]->nome}}</h1>
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
          </tbody>
        </table>
      </div>
</div>
