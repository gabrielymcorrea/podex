@include('app')
<body id="body-pd">
    <header class="header" id="header">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
        <div class="header_img"> <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="img-fluid"> </div>
    </header>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div> <a href="#" class="nav_logo"> <i class='bx bx-layer nav_logo-icon'></i> <span class="nav_logo-name">Podex</span> </a>
                <div class="nav_list"> 
                    <a href="/" class="nav_link"> <i class='bx bx-home'></i> <span class="nav_name">Início </span> </a> 
                    <a href="{{route('index_categoria')}}" class="nav_link active"> <i class='bx bx-category nav_icon'></i> <span class="nav_name">Categoria</span> </a>
                    <a href="{{route('perfil')}}" class="nav_link"> <i class='bx bxl-audible'></i> <span class="nav_name">Canal podcast</span> </a>  
                </div>
            </div> 
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">Sair</span> </a>
            </form>
        </nav>
    </div>

    {{-- <div class="height-100 bg-light">
        <h4>Main Components</h4>
    </div> --}}
