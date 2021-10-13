<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Podex</title>

    <link rel="icon" href="{{ asset('favicon.svg') }}" sizes="any" type="image/svg+xml">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <style>
        body {
            margin-top: 20px;
            background-color: #121212;
            font-family: var(--body-font);
            color: #eee;
            overflow: hidden;
        }

        .btn-entrar {
            background-color: transparent;
            border: solid 2px #4723D9;
            width: 120px;
            color: #4723D9;
        }

        .btn-entrar:hover {
            color: #fff;
            background-color: #4723D9;
            box-shadow: none;
        }

        .cadastrar {
            border-right: 1px solid #222222;
            margin-right: 20px;
            padding: 10px;
            float: right;
            color: #eee;
            text-decoration: none;
        }

        .cadastrar:hover,
        .link_login:hover {
            color: #4723D9;
        }

        h4 {
            font-size: 2rem;
            font-weight: bold;
        }

        .link_login {
            color: #eee;
            text-transform: uppercase;
            font-weight: bold;
        }

        svg {
            position: absolute;
            top: 100%;
            -webkit-transform: translateY(-50%);
            -ms-transform: translateY(-50%);
            transform: translateY(-50%);
            left: 0;
            right: 0;
        }

        .sobre {
            margin-top: 120px;
        }

        .rede_social {
            font-size: 1.9rem;
            color: #eee;
        }

        .rede_social:hover {
            color: #4723D9;
            -webkit-animation: heartbeat 1.5s ease-in-out infinite both;
            animation: heartbeat 1.5s ease-in-out infinite both;
        }

        .logado{
            float:right;
            color: #eee;
            font-size:1.2rem;
            text-decoration: none;
            font-family: var(--body-font);
        }

        .logado:hover{
            color: #4723D9;
        }

        @media(max-width:767px) {
            .img_home {
                display: none;
            }

            .sobre {
                margin-top: 70px;
                width: 100% !important;
            }

            .cadastrar {
                display: none;
            }

            svg {
                top: 94%;
            }
        }

        @-webkit-keyframes heartbeat {
            from {
                -webkit-transform: scale(1);
                transform: scale(1);
                -webkit-transform-origin: center center;
                transform-origin: center center;
                -webkit-animation-timing-function: ease-out;
                animation-timing-function: ease-out;
            }

            10% {
                -webkit-transform: scale(0.91);
                transform: scale(0.91);
                -webkit-animation-timing-function: ease-in;
                animation-timing-function: ease-in;
            }

            17% {
                -webkit-transform: scale(0.98);
                transform: scale(0.98);
                -webkit-animation-timing-function: ease-out;
                animation-timing-function: ease-out;
            }

            33% {
                -webkit-transform: scale(0.87);
                transform: scale(0.87);
                -webkit-animation-timing-function: ease-in;
                animation-timing-function: ease-in;
            }

            45% {
                -webkit-transform: scale(1);
                transform: scale(1);
                -webkit-animation-timing-function: ease-out;
                animation-timing-function: ease-out;
            }
        }

        @keyframes heartbeat {
            from {
                -webkit-transform: scale(1);
                transform: scale(1);
                -webkit-transform-origin: center center;
                transform-origin: center center;
                -webkit-animation-timing-function: ease-out;
                animation-timing-function: ease-out;
            }

            10% {
                -webkit-transform: scale(0.91);
                transform: scale(0.91);
                -webkit-animation-timing-function: ease-in;
                animation-timing-function: ease-in;
            }

            17% {
                -webkit-transform: scale(0.98);
                transform: scale(0.98);
                -webkit-animation-timing-function: ease-out;
                animation-timing-function: ease-out;
            }

            33% {
                -webkit-transform: scale(0.87);
                transform: scale(0.87);
                -webkit-animation-timing-function: ease-in;
                animation-timing-function: ease-in;
            }

            45% {
                -webkit-transform: scale(1);
                transform: scale(1);
                -webkit-animation-timing-function: ease-out;
                animation-timing-function: ease-out;
            }
        }

    </style>

</head>

<body>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path fill="#222222" fill-opacity="1"
            d="M0,160L21.8,149.3C43.6,139,87,117,131,101.3C174.5,85,218,75,262,101.3C305.5,128,349,192,393,186.7C436.4,181,480,107,524,85.3C567.3,64,611,96,655,96C698.2,96,742,64,785,69.3C829.1,75,873,117,916,128C960,139,1004,117,1047,122.7C1090.9,128,1135,160,1178,197.3C1221.8,235,1265,277,1309,277.3C1352.7,277,1396,235,1418,213.3L1440,192L1440,320L1418.2,320C1396.4,320,1353,320,1309,320C1265.5,320,1222,320,1178,320C1134.5,320,1091,320,1047,320C1003.6,320,960,320,916,320C872.7,320,829,320,785,320C741.8,320,698,320,655,320C610.9,320,567,320,524,320C480,320,436,320,393,320C349.1,320,305,320,262,320C218.2,320,175,320,131,320C87.3,320,44,320,22,320L0,320Z">
        </path>
    </svg>
    <div class="container">
        <div class="row">
            <div class="col-6">
                <img src="logo.png" class="img-fluid">
            </div>

            <div class="col-6">
                @if(Auth::check())
                    <a class="nav-link dropdown-toggle logado" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Olá, {{Auth::user()->name}}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                        <li><a class="dropdown-item" href="{{route('conta')}}">Conta</a></li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="dropdown-item" href="#">Sair</a></li>
                        </form>
                    </ul>
                @else
                    <a href="/login" class="btn btn-entrar" style="float:right;">Entrar</a>
                    <a href="/register" class="cadastrar">Cadastrar</a>
                @endif
            </div>

            <div class="row" style="margin-top: 70px;">
                <div class="col-6 sobre">
                    <h4> Um pouquinho sobre quem somos </h4>
                    <p> Três colegas em busca da realização do tcc. A meta é se livrar dessa merda de rolê(faculdade)
                        que ta chatão já kkkk(cada K uma lagrima), embarque nessa aventura com a gente? <a
                            href="{{route('dashboard')}}" class="link_login"> bora lá </a>
                    <div>
                        <i class='bx bxl-facebook-square rede_social'></i>
                        <i class='bx bxl-instagram-alt rede_social'></i>
                        <i class='bx bxl-youtube rede_social'></i>
                        <i class='bx bxl-linkedin-square rede_social'></i>
                    </div>
                </div>
                <div class="col-6">
                    <img src="home.png" class="img-fluid img_home">
                </div>
            </div>
        </div>
    </div>
</body>

</html>
