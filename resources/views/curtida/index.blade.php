@section('title', 'Curtida')
@include('sidebar')

<div class="height-100">
    <div class="row"> 
        <div style="height:280px; width:280px;">
            <img src="curtida.png" alt="curtida" class="img-fluid" />
        </div>
        <div class="col-md-6" style="margin-top: 30px"> 
            <h1 style="font-weight:bold;"> Minhas curtidas</h1>
            <p> {{Auth::user()->name }} </p>
            <p> 10 curtida <i class='bx bxs-like'></i> </p> 
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
         
          </tbody>
        </table>
      </div>
</div>
