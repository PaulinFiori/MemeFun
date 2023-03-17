<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <a class="navbar-brand mt-2 mt-lg-0" href="{{route('home')}}">
                <img src="{{ asset('images/logo.png') }}" height="70" alt="Logo" loading="lazy"/>
            </a>

            <ul class="navbar-nav me-auto mb-2 mb-lg-0 mx-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('home')}}">
                        <i class="fa-solid fa-house"></i>
                        Início
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('melhores')}}">
                        <i class="fa-solid fa-star"></i>
                        Melhores
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('seguidores')}}">
                        <i class="fa-solid fa-rss"></i>
                        Seguindo
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('comunidades')}}">
                        <i class="fa-solid fa-users"></i>
                        Comunidade
                    </a>
                </li>
            </ul>

            <div class="container-fluid d-block d-md-none mb-3">
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Procurar memes ou usuários" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Procurar</button>
                </form>
            </div>
        </div>

        <div class="d-flex align-items-center">
            <div class="container-fluid d-none d-md-flex">
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Procurar memes ou usuários" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
            
            @if(auth()->user() != null)
                <a class="text-reset me-3" href="{{route('novo-post')}}">
                    <i class="fa-solid fa-plus"></i>
                </a>
            
                <a href="#notifications_menu" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
                    data-caret="false">
                    <i class="fas fa-bell"></i>
                    @if(1 > 0)
                        <span class="badge badge-danger" style="right: 0; background: #e55039">1</span>
                    @endif
                </a>

                <div id="notifications_menu" class="dropdown-menu dropdown-menu-right navbar-notifications-menu">
                    <div class="dropdown-item d-flex align-items-center py-2" style="cursor: default;">
                        <span class="flex notificacao-title m-0">Notificações</span>
                    </div>
                    <div class="navbar-notifications-menu__content" data-perfect-scrollbar>
                        @php
                            $notificacoes = ["oi"];
                        @endphp

                        @foreach($notificacoes as $notificacao)
                            @php
                                $mensagem = "Teste";
                                //$mensagem = \App\Models\Mensagens::find($notificacao->fk_id_mensagem);
                            @endphp

                            @if($mensagem != null)
                            <div class="py-2 cp" onclick="window.location.href = '{{route('home')}}'">
                                <div class="dropdown-item d-flex">
                                    <div class="mr-3">
                                        <div class="avatar avatar-sm" style="width: 32px; height: 32px;">
                                            @if(true)
                                                <img src="images/default-user.jpg" alt="avatar"
                                                        style="height: 32px; width: 32px" class="avatar-img rounded-circle">
                                            @else
                                                <img src="images/default-user.jpg" alt="avatar" style="height: 32px; width: 32px"
                                                        class="avatar-img rounded-circle">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="d-block mx-3">
                                        <strong class="d-block">Paulo</strong>
                                        "Oi..."
                                        <a href="">Meme 1</a>
                                        <br>
                                        <small class="text-muted">há 1 minuto</small>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="dropdown">
                @if(auth()->user() != null)
                    <a class="dropdown-toggle d-flex align-items-center hidden-arrow text-black" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ config('app.url'). '/' . auth()->user()->foto }}" class="rounded-circle" height="25" alt="User Foto" loading="lazy"/>
                    </a>
                @else
                    <a class="dropdown-toggle d-flex align-items-center hidden-arrow text-black" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('images/default-user.jpg') }}" class="rounded-circle" height="25" alt="User Photo" loading="lazy"/>
                    </a>
                @endif

                <div class="dropdown-menu dropwdown-perfil">
                    @if(auth()->user() != null)
                        <a class="dropdown-item" href="{{route('perfil', [auth()->user()->id])}}">
                            <i class="fa-solid fa-user"></i>
                            Perfil
                        </a>
                        <a class="dropdown-item" href="{{route('editar-perfil')}}">
                            <i class="fa-solid fa-user-pen"></i>
                            Editar Perfil
                        </a>
                        <a class="dropdown-item" href="{{route('configuracoes')}}">
                            <i class="fa-solid fa-gear"></i>
                            Configurações
                        </a>
                        <a class="dropdown-item" href="{{route('ranking')}}">
                            <i class="fa-solid fa-trophy"></i>
                            Ranking
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                <i class="fa-solid fa-right-from-bracket"></i>
                                Sair
                            </a>
                        </form>
                    @else
                        <a class="dropdown-item" href="{{route('login')}}">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            Entrar
                        </a>
                        <a class="dropdown-item" href="{{route('cadastro')}}">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            Registrar-se
                        </a>
                    @endif
                </div>
            </div>
        </div>
  </div>
</nav>