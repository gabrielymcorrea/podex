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

</div>