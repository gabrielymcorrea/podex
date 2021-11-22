
<header class="header" id="header">
    <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
    <span class="ola-sidebar"> Olá, {{ Auth::user()->name }} </span>
</header>
<div class="l-navbar" id="nav-bar">
    <nav class="nav">
        <div> <a href="#" class="nav_logo"> <i class='bx bx-layer nav_logo-icon'></i> <span
                    class="nav_logo-name">Podex</span> </a>
            <div class="nav_list">
                <a href="/" class="nav_link active"> <i class='bx bx-home '></i> <span class="nav_name">Início
                    </span> </a>
                <a href="{{ route('dashboard') }}" class="nav_link"> <i class='bx bx-category nav_icon' data-bs-toggle="tooltip" data-bs-placement="right" title="Categoria"></i>
                    <span class="nav_name">Categoria</span> </a>
                <a href="{{ route('conta') }}" class="nav_link"><i class='bx bx-pencil' data-bs-toggle="tooltip" data-bs-placement="right" title="Conta"></i><span
                        class="nav_name">Conta</span> </a>
                <a href="{{ route('show', Auth::user()->id) }}" class="nav_link"> <i class='bx bxs-user-detail' data-bs-toggle="tooltip" data-bs-placement="right" title="Perfil"></i><span
                        class="nav_name">Perfil</span> </a>
                <a href="{{ route('add_ep') }}" class="nav_link"><i class='bx bx-message-square-add' data-bs-toggle="tooltip" data-bs-placement="right" title="Postar Podcast"></i>
                    <span class="nav_name">Postar Podcast</span> </a>
                <a href="{{ route('playlist') }}" class="nav_link"> <i class='bx bxs-playlist' data-bs-toggle="tooltip" data-bs-placement="right" title="Minhas playlist"></i><span
                        class="nav_name">Minhas playlist</span> </a>
                <a href="{{ route('curtida') }}" class="nav_link"> <i class='bx bx-like' data-bs-toggle="tooltip" data-bs-placement="right" title="Minhas curtidas"></i><span
                        class="nav_name">Minhas curtidas</span> </a>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"
                class="nav_link"> <i class='bx bx-log-out nav_icon' data-bs-toggle="tooltip" data-bs-placement="right" title="Sair"></i> <span class="nav_name" >Sair</span>
            </a>
        </form>
    </nav>
</div>

