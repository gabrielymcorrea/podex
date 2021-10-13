@section('title', $data[0]->name_podcast)
@include('sidebar')

<style>
    .podcast_por {
      color: #eee;
      font-size: 1.3rem;
    }

    .podcast_por:hover {
      color: #4723D9;
      text-decoration: underline !important;
    }

    .id-ep:hover,
    .add_playlist:hover {
      cursor: pointer;
    }

    .bx-heart:hover,
    .bx-add-to-queue:hover,
    .bxs-heart:hover,
    .bx-pause:hover,
    .bx-play:hover,
    .bx-trash-alt:hover,
    .bx-edit-alt:hover {
      color: #eee;
      cursor: pointer;
    }

    td,
    th,
    tr {
      border: none;
    }

    .bx-add-to-queue {
      color: #56545a;
    }

    .nav-link {
      display: inline-block;
      padding: 0px;
    }

    .destaque {
      background: #222121;
    }

    td:hover,
    tr:hover,
    h1:hover,
    p:hover {
        cursor: default;
    }

    .img-fluid {
      height: 250px ;
      object-fit: cover;
    }

    .modal-content {
      background-color: #181818;
    }

    .modal-header {
      border-bottom: 1px solid #222222;

    }

    .modal-footer {
      border-top: 1px solid #222222;
    }

    .btn-close:focus, .btn:focus {
      box-shadow: none;
    }

    .form-perfil {
      color: #fff;
      background-color: #181818;
      border: none;
      border-radius: 0;
    }

    .form-perfil,
    .form-perfil:hover,
    .form-perfil:focus,
    .form-perfil:active {
      color: #fff;
      -webkit-text-fill-color: #8f8d8d ;
      -webkit-box-shadow: 0 0 0px 1000px #222222 inset;
    }

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

  .bx-heart:hover, .bx-add-to-queue:hover, .bxs-heart:hover, .bx-pause:hover, .bx-play:hover, .bx-trash-alt:hover{
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
    background:#222121;
  }

  td:hover, tr:hover,h1:hover, p:hover{
    cursor: default;
  }

  .gif_som{
    height:15px;
    opacity: 0;
    margin-bottom: 8px;
  }

  .footer-play{
    width: 100%;
    height: 100px;
    background: #000;
    color: #fff;
    padding: 0px;
    margin: 0px;
    position: fixed;
    bottom: 0;
    left: 0;
  }
</style>


<div class="height-100">
    @if (\Session::has('success'))
      <div class="alert alert-primary" role="alert">
          {!! \Session::get('success') !!}
      </div>
    @endif

    <div class="add-alert"></div>

    <div class="row">
      <div style="height:250px; width:280px;">
        @if ($data[0]->profile_photo_path)
          <img src="{{ asset('storage/' . $data[0]->profile_photo_path) }}" alt="{{ $data[0]->name_podcast }}" class="img-fluid" />
        @else
          <img src="{{ asset('semimage.png') }}" alt="podex" class="img-fluid" />
        @endif
      </div>
      <div class="col-md-6">
        <h1 style="font-weight:bold;"> {{ isset($data[0]->name_podcast) ? $data[0]->name_podcast : '' }}</h1>
        <a href="" class="podcast_por">Por {{ isset($data[0]->name) ? $data[0]->name : '' }}</a>
        <p style="margin-top:10px;color: #bbb;">{{ isset($data[0]->descricao) ? $data[0]->descricao : '' }}</p>
      </div>
    </div>

    <div class="row">
      <table class="table" id="ep">
        <thead style="border-bottom: 1px solid #342C2C;">
          <tr style="color: #56545a;">
            <th scope="col " style="width: 30px">#</th>
            <th scope="col">Título</th>
            <th scope="col" style="width: 200px"></th>
          </tr>
        </thead>
        
        <tbody style="color: #56545a;">
          @foreach ($eps as $key => $ep)
            <tr id="{{ $ep->id }}">
              <td scope="row" style="width: 40px">
                <i class="bx bx-play" id="play{{ $key }}"></i>
                <i class='bx bx-pause' id="pause{{ $key }}" style="display: none;"></i>
                <audio controls id="demo{{ $key }}" src="http://127.0.0.1:8000/storage/audio_ep/{{ $ep->name_audio }}" style="display: none;"></audio>
              </td>
              
              <td style="color: #eee;">{{ $ep->name_ep }}</td>
              
              <td style="width: 200px">
                <img src="{{ asset('sound.gif') }}" alt="gif som" class="gif_som" id="gif_som{{$key}}"/>
                @if (Auth::user()->id == $ep->id_user)
                  <i class='bx bx-trash-alt' id-ep="{{ $ep->id }}" data-bs-toggle="tooltip" data-bs-placement="right" title="Deletar"></i>
                @endif

                @if (Auth::user()->id == $ep->id_user)
                  <i class='bx bx-edit-alt' id-ep="{{ $ep->id }}" data-bs-toggle="modal" data-bs-target="#modalEdit" data-bs-toggle="tooltip" data-bs-placement="right" title="Editar"></i>
                @else
                  <i id-ep="{{ $ep->id }}" data-bs-toggle="tooltip" data-bs-placement="right" title="Curtir"
                    @if (count($curtidas) != 0)
                      @foreach ($curtidas as $cut)
                        @if ($cut->id_ep == $ep->id)
                            class='bx bxs-heart'
                        @else
                            class='bx bx-heart'
                        @endif
                      @endforeach
                    @else
                      class='bx bx-heart'
                    @endif >
                  </i>
                  <a class="nav-link dropdown logado" href="#" id="navbarDarkDropdownMenuLink" role="button"
                      data-bs-toggle="dropdown" aria-expanded="false">
                      <i class='bx bx-add-to-queue' data-bs-toggle="tooltip" data-bs-placement="right" title="Criar playlist"></i>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                      @if (count($playlist) <= 5)
                          <li><a class="dropdown-item add_playlist" id-ep="{{ $ep->id }}"
                                  id-playlist="0">Nova playlist</a></li>
                      @endif
                      @foreach ($playlist as $play)
                          <li><a class="dropdown-item add_playlist" id-playlist="{{ $play->id }}"
                                  id-ep="{{ $ep->id }}">{{ $play->nome }}</a></li>
                      @endforeach
                  </ul>
                @endif

                <span>{{ $ep->temp_audio }}</span>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <div class="row">
      <!-- Modal edit -->
      <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Novo título</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" data-bs-toggle="tooltip" data-bs-placement="right" title="Sair"></button>
            </div>
            <div class="modal-body">
              <form action="{{ route('edit_titulo') }}" method="POST">
                @csrf
                <div style="display: flex;">
                  <input type="hidden" id="id_ep" name="id_ep"/>
                  <input type="text" placeholder="Novo título" name="novo_titulo" class="form-control form-perfil" />
                  <button type="submit" class="btn" style="color: #eee;border-radius: 0; background:#222222"> <i class='bx bx-send' data-bs-toggle="tooltip" data-bs-placement="right" title="Enviar alterações"></i> </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div> 

    {{-- <div class="footer-play">
      <div style="display: flex; justify-content: center;"> 
        <div class="row" style="display: flex; flex-wrap: nowrap; flex-direction: row;justify-content: center;"> 
          <i class='bx bx-arrow-to-left'></i> <i class='bx bxs-caret-right-square'></i> <i class='bx bx-arrow-to-right' ></i> 
        </div>
        <div class="row"></div>
      </div>
    </div> --}}
</div>

<script>
    //remove alert
    setTimeout(function() {
      $('.div-alert').remove();
    }, 4000);

    setTimeout(function() {
      $(".alert").fadeOut("slow", function(){
        $(this).alert('close');
      });				
    }, 5000);	

    //linha cinza hover 
    $(function() {
      $('table#ep tbody tr').hover(
        function() {
          $(this).addClass('destaque');
        },
        function() {
          $(this).removeClass('destaque');
        }
      );
    });

    //play audio
    $("[id^=play]").click(function(event) {
        const id = this.id.slice(4);

        document.getElementById('demo' + id).play();
        $(this).hide();
        $('#pause' + id).show();
        $('#gif_som' +id).css('opacity',1);
    });

    //pause o audio que esta tocando para que o outro possar dar o play e tocar sozinho, reinicia o time do algo anterior
    document.addEventListener('play', function(e) {
        var audios = document.getElementsByTagName('audio');
        for (var i = 0, len = audios.length; i < len; i++) {
            if (audios[i] != e.target) {
                var id = audios[i].id
                var id = id.replace(/[^0-9]/g, '');

                $('#pause' + id).hide();
                $('#play' + id).show();
                $('#gif_som' +id).css('opacity',0);

                audios[i].pause();
                audios[i].currentTime = 0
            }
        }
    }, true);

    //pause audio
    $("[id^=pause]").click(function() {
        const id = this.id.slice(5);
        document.getElementById('demo' + id).pause();
        $(this).hide();
        $('#play' + id).show();
        $('#gif_som' +id).css('opacity',0);
    });

    //salvar status da curtida, curtir
    $("i.bx-heart").click(function() {
      var id_ep = $(this).attr('id-ep')
      var acao = $(this)[0];

      var dar_like = document.querySelector("i.bx-heart");
      var tirar_like = document.querySelector("i.bxs-heart");
      $(this).toggleClass("bxs-heart bx-heart");

      if (acao == dar_like) {
        var dados = {
            'acao': 1,
            'id_ep': id_ep,
        };
      }

      if (acao == tirar_like) {
        var dados = {
            'acao': 2,
            'id_ep': id_ep,
        };
      }

      $.ajax({
        url: "/curtida",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        data: dados,
        dataType: 'json',
        success: function(data) {
          if (acao == tirar_like) {
            $(".div-alert").remove()
            var frase = 'Removido em curtidas';
            $(".add-alert").append(`<div class="div-alert"> <p> ${frase} </p> </div>`);
            //remove alert
            setTimeout(function() {
              $('.div-alert').remove();
            }, 4000);
          }

          if (acao == dar_like) {
            $(".div-alert").remove()
            var frase = 'Adicionado em curtidas';
            $(".add-alert").append(`<div class="div-alert"> <p> ${frase} </p> </div>`);
            //remove alert
            setTimeout(function() {
              $('.div-alert').remove();
            }, 4000);
          }
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

      if (acao == dar_like) {
        var dados = {
            'acao': 1,
            'id_ep': id_ep,
        };
      }

      if (acao == tirar_like) {
        var dados = {
            'acao': 2,
            'id_ep': id_ep,
        };
      }

      $.ajax({
        url: "/curtida",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        data: dados,
        dataType: 'json',
        success: function(data) {
          if (acao == tirar_like) {
            $(".div-alert").remove()
            var frase = 'Removido em curtidas';
            $(".add-alert").append(`<div class="div-alert"> <p> ${frase} </p> </div>`);
            //remove alert
            setTimeout(function() {
              $('.div-alert').remove();
            }, 4000);
          }

          if (acao == dar_like) {
            $(".div-alert").remove()
            var frase = 'Adicionado em curtidas';
            $(".add-alert").append(`<div class="div-alert"> <p> ${frase} </p> </div>`);
            //remove alert
            setTimeout(function() {
              $('.div-alert').remove();
            }, 4000);
          }
        }
      });
    });

    //excluit ep quando o ep for seu
    $("i.bx-trash-alt").click(function() {
      var id_ep = $(this).attr('id-ep');

      var dados = {
        'id_ep': id_ep,
      };
      $.ajax({
        url: "/delete_ep",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        data: dados,
        dataType: 'json',
        success: function(data) {
          $(".div-alert").remove();
          var frase = 'Episódio removido';
          $(".add-alert").append(`<div class="div-alert"> <p> ${frase} </p> </div>`);
          $('#' + id_ep).hide();

          //remove alert
          setTimeout(function() {
            $('.div-alert').remove();
          }, 4000);
        }
      });
    });

    //passando dados para modal edit
    $('.bx-edit-alt').on('click', function(){
      var id_ep = $(this).attr('id-ep');
      $("#id_ep").val(id_ep);
    });
</script>
