{{-- <x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Senha') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Lembre me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
            {{ __('Forgot your password?') }}
            </a>
            @endif

            <x-jet-button class="ml-4">
                {{ __('Log in') }}
            </x-jet-button>
            </div> 
        </form>
    </x-jet-authentication-card>
</x-guest-layout> --}}

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Podex - Login </title>

    <link rel="icon" href="favicon.svg" sizes="any" type="image/svg+xml">
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

        .form-perfil {
            color: #fff;
            background-color: #222222;
            border: none;
        }

        .label-perfil {
            color: #fff;
        }


        .form-floating>label {
            color: #fff;
        }

        input:focus,
        input:active,
        textarea:focus,
        textarea:active {
            background-color: #222222 !important;
            color: #fff !important;
        }

        input:-webkit-autofill,
        input:-webkit-autofill:hover, 
        input:-webkit-autofill:focus,
        textarea:-webkit-autofill,
        textarea:-webkit-autofill:hover
        textarea:-webkit-autofill:focus,
        select:-webkit-autofill,
        select:-webkit-autofill:hover,
        select:-webkit-autofill:focus {
            -webkit-text-fill-color: #fff;
            -webkit-box-shadow: 0 0 0px 1000px #222222 inset;
        }

        .login {
            display: flex;
            width: 100%;
            height: 100vh;
            flex-wrap: nowrap;
            align-content: center;
            justify-content: center;
            align-items: center;
        }

        .btn-enviar {
            background: #6D60E0;
            color: #fff;
            width: 200px;
        }

        .btn-enviar:hover {
            background: #6d60e085;
            color: #FFFFFF;
        }

        .container-login {
            width: 40%;
        }

        .form-perfil:focus {
            box-shadow: none;
        }


        @media (max-width: 800px) {
            .container-login {
                width: 70%;
            }
        }

        .icon_voltar {
            border-radius: 100%;
            background-color: #181818;
            height: 30px;
            width: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }

        .icon_voltar:hover {
            background-color: #222222;
            cursor: pointer;
        }

        ul {
            list-style: none;
        }

        a:hover{
            text-decoration: underline !important;
        }
    </style>

</head>

<body>
    <div class="login">
        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="container-login">
            @csrf

            <div class="row">
                <div class="col-md-12" style="text-align: center; margin-bottom:20px;">
                    <a href="{{ route('home') }}"> 
                        <img src="logo.png" class="img-fluid">
                    </a>
                    <x-jet-validation-errors style="margin-top:10px" />
                </div>

                <div class="col-md-12">
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control form-perfil" id="email" name="email"
                            placeholder="Leave a comment here">
                        <label for="email" class="label-perfil">Email</label>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control form-perfil" id="password" name="password"
                            placeholder="Leave a comment here">
                        <label for="password" class="label-perfil">Senha</label>
                    </div>
                </div>

                <div class="col-md-12" style="text-align: center;">
                    <button class="btn btn-enviar" type="submit"> Entrar </button>
                </div>
                <a href="{{route('register')}}" style="text-align: center;color: #eee;text-decoration:none;">N??o possui conta? cadastre-se</a>
            </div>
        </form>
    </div>
</body>

</html>
