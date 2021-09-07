@include('app')
<body id="body-pd">
    <header class="header" id="header">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
        <div class="header_img"> <img src="https://i.imgur.com/hczKIze.jpg" alt=""> </div>
    </header>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div> <a href="#" class="nav_logo"> <i class='bx bx-layer nav_logo-icon'></i> <span class="nav_logo-name">BBBootstrap</span> </a>
                <div class="nav_list"> 
                    <a href="#" class="nav_link active"> <i class='bx bx-home nav_icon'></i> <span class="nav_name">Início </span> </a> 
                    <a href="#" class="nav_link"> <i class='bx bx-category nav_icon'></i> <span class="nav_name">Categoria</span> </a> 
                </div>
            </div> 
            <a href="#" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">Sair</span> </a>
        </nav>
    </div>

    {{-- <div class="height-100 bg-light">
        <h4>Main Components</h4>
    </div> --}}
