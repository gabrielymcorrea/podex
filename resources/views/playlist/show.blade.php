@section('title', 'Playlist')
@include('sidebar')

<style>
    td, th, tr {
        border: none;
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
          </tbody>
        </table>
      </div>
</div>
