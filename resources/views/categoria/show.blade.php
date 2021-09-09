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

.id-ep:hover{
    cursor: pointer;
}
</style>
<div class="height-100">
    <div class="row"> 
        <div style="height:310px; width:310px;">
            <img src="{{ asset('storage/'.$data[0]->profile_photo_path) }}" alt="{{ $data[0]->name_podcast }}" class="img-fluid" />
        </div>
        <div class="col-md-6"> 
            <h1 style="font-weight:bold;"> {{isset($data[0]->name_podcast) ? $data[0]->name_podcast : ''}}</h1>
            <a href="" class="podcast_por">Por {{isset($data[0]->name) ? $data[0]->name : ''}}</a>
            <p style="margin-top:10px;color: #bbb;">Por {{isset($data[0]->descricao) ? $data[0]->descricao : ''}}</p>
        </div>
    </div>

    <div class="row">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Título</th>
                <th scope="col"><i class='bx bx-time'></i></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row" class="id-ep"><i onlouseovere="normal();">1</i></th>
                <td>Mark</td>
                <td >Otto</td>
              </tr>
            </tbody>
          </table>
    </div>

</div>

<script>

function normal() {
    console.log('ola')
}

</script>