@extends('layouts.basicLayout')

@section('titulo', 'MemeFun - Perfil')

@section('conteudo')
    <link rel="stylesheet" href="{{ asset('css/perfil.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/posts.css') }}"/>
    
    @php
        $banner = '';

        if($usuario->banner != null) {
            $banner = config('app.url' ) . '/' . $usuario->banner;
        }
        else {
            $banner = "../images/fundoroxo.jpg";
        }
    @endphp
    <div class="container-fluid">
        <div class="banner" style="background-image: url({{ $banner }});">
            @if($usuario->foto != null)
                <img src="{{ config('app.url'). '/' . $usuario->foto }}" class="rounded-circle" width="100px" heigth="100px">
            @else
                <img src="{{ asset('images/default-user.jpg') }}" class="rounded-circle" width="100px" heigth="100px">
            @endif
            <span class="font-weight-bold link-perfil name-perfil"
                @if($usuario->configuracao) style="color: {{ $usuario->configuracao->texto_cor }} !important; 
                text-shadow: 2px 0 {{ $usuario->configuracao->borda_texto_cor }}, -2px 0 {{ $usuario->configuracao->borda_texto_cor }}, 0 2px {{ $usuario->configuracao->borda_texto_cor }}, 0 -2px {{ $usuario->configuracao->borda_texto_cor }},
                1px 1px {{ $usuario->configuracao->borda_texto_cor }}, -1px -1px {{ $usuario->configuracao->borda_texto_cor }}, 1px -1px {{ $usuario->configuracao->borda_texto_cor }}, -1px 1px {{ $usuario->configuracao->borda_texto_cor }} !important;" >
                {{ $usuario->name }} @endif
            </span>

            @auth
                @php
                    $segue = false;
                    foreach(auth()->user()->seguindo as $seguindo) {
                        if($seguindo->user_seguindo == $usuario->id) {
                            $segue = true;
                        }
                    }
                @endphp
                @if(auth()->user()->id != $usuario->id && $segue == false)
                    <span class="font-weight-bold link-perfil cursor-pointer float-right seguir" onclick="seguir({{$usuario->id}})"
                        @if($usuario->configuracao) style="color: {{ $usuario->configuracao->texto_cor }} !important; 
                        text-shadow: 2px 0 {{ $usuario->configuracao->borda_texto_cor }}, -2px 0 {{ $usuario->configuracao->borda_texto_cor }}, 0 2px {{ $usuario->configuracao->borda_texto_cor }}, 0 -2px {{ $usuario->configuracao->borda_texto_cor }},
                        1px 1px {{ $usuario->configuracao->borda_texto_cor }}, -1px -1px {{ $usuario->configuracao->borda_texto_cor }}, 1px -1px {{ $usuario->configuracao->borda_texto_cor }}, -1px 1px {{ $usuario->configuracao->borda_texto_cor }} !important;" @endif >
                        <i class="fa-solid fa-user-plus"></i>
                    </span>
                @elseif(auth()->user()->id != $usuario->id && $segue)
                    <span class="font-weight-bold link-perfil cursor-pointer float-right seguir" onclick="deseguir({{$usuario->id}})"
                        @if($usuario->configuracao) style="color: {{ $usuario->configuracao->texto_cor }} !important; 
                        text-shadow: 2px 0 {{ $usuario->configuracao->borda_texto_cor }}, -2px 0 {{ $usuario->configuracao->borda_texto_cor }}, 0 2px {{ $usuario->configuracao->borda_texto_cor }}, 0 -2px {{ $usuario->configuracao->borda_texto_cor }},
                        1px 1px {{ $usuario->configuracao->borda_texto_cor }}, -1px -1px {{ $usuario->configuracao->borda_texto_cor }}, 1px -1px {{ $usuario->configuracao->borda_texto_cor }}, -1px 1px {{ $usuario->configuracao->borda_texto_cor }} !important;" @endif >
                        <i class="fa-solid fa-user-minus"></i>
                    </span>
                @elseif(auth()->user()->id == $usuario->id)
                    <div class="links-banner">
                        <form method="POST" action="{{ route('logout') }}" class="font-weight-bold link-perfil-sair cursor-pointer float-right seguir d-block d-lg-none">
                            @csrf
                            <span class="font-weight-bold link-perfil-sair cursor-pointer float-right seguir mx-3" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                <i class="fa-solid fa-right-from-bracket" @if($usuario->configuracao) style="color: {{ $usuario->configuracao->texto_cor }} !important; 
                                    text-shadow: 2px 0 {{ $usuario->configuracao->borda_texto_cor }}, -2px 0 {{ $usuario->configuracao->borda_texto_cor }}, 0 2px {{ $usuario->configuracao->borda_texto_cor }}, 0 -2px {{ $usuario->configuracao->borda_texto_cor }},
                                    1px 1px {{ $usuario->configuracao->borda_texto_cor }}, -1px -1px {{ $usuario->configuracao->borda_texto_cor }}, 1px -1px {{ $usuario->configuracao->borda_texto_cor }}, -1px 1px {{ $usuario->configuracao->borda_texto_cor }} !important;" @endif>
                                </i>
                            </span>
                        </form>
                        <span class="font-weight-bold link-perfil edit-icon cursor-pointer float-right seguir margin-edit" onclick="window.location.href = '{{ route('editar-perfil') }}'">
                            <i class="fa-solid fa-pen-to-square"
                                @if($usuario->configuracao) style="color: {{ $usuario->configuracao->texto_cor }} !important; 
                                text-shadow: 2px 0 {{ $usuario->configuracao->borda_texto_cor }}, -2px 0 {{ $usuario->configuracao->borda_texto_cor }}, 0 2px {{ $usuario->configuracao->borda_texto_cor }}, 0 -2px {{ $usuario->configuracao->borda_texto_cor }},
                                1px 1px {{ $usuario->configuracao->borda_texto_cor }}, -1px -1px {{ $usuario->configuracao->borda_texto_cor }}, 1px -1px {{ $usuario->configuracao->borda_texto_cor }}, -1px 1px {{ $usuario->configuracao->borda_texto_cor }} !important;" @endif>
                            </i>
                        </span>

                        <a class="font-weight-bold link-perfil cursor-pointer float-right seguir mx-3 d-block d-lg-none" href="{{route('ranking')}}">
                            <i class="fa-solid fa-trophy"
                                @if($usuario->configuracao) style="color: {{ $usuario->configuracao->texto_cor }} !important; 
                                text-shadow: 2px 0 {{ $usuario->configuracao->borda_texto_cor }}, -2px 0 {{ $usuario->configuracao->borda_texto_cor }}, 0 2px {{ $usuario->configuracao->borda_texto_cor }}, 0 -2px {{ $usuario->configuracao->borda_texto_cor }},
                                1px 1px {{ $usuario->configuracao->borda_texto_cor }}, -1px -1px {{ $usuario->configuracao->borda_texto_cor }}, 1px -1px {{ $usuario->configuracao->borda_texto_cor }}, -1px 1px {{ $usuario->configuracao->borda_texto_cor }} !important;" @endif>
                            </i>
                        </a>

                        <a class="font-weight-bold link-perfil cursor-pointer float-right seguir d-block d-lg-none" href="{{route('configuracoes')}}">
                            <i class="fa-solid fa-gear"
                                @if($usuario->configuracao) style="color: {{ $usuario->configuracao->texto_cor }} !important; 
                                text-shadow: 2px 0 {{ $usuario->configuracao->borda_texto_cor }}, -2px 0 {{ $usuario->configuracao->borda_texto_cor }}, 0 2px {{ $usuario->configuracao->borda_texto_cor }}, 0 -2px {{ $usuario->configuracao->borda_texto_cor }},
                                1px 1px {{ $usuario->configuracao->borda_texto_cor }}, -1px -1px {{ $usuario->configuracao->borda_texto_cor }}, 1px -1px {{ $usuario->configuracao->borda_texto_cor }}, -1px 1px {{ $usuario->configuracao->borda_texto_cor }} !important;" @endif>
                            </i>
                        </a>
                    </div>
                @endif
            @endauth
            <br>
            <div class="d-flex user-infos text-center">
                <a class="mx-5 link-abas" @if($usuario->configuracao) style="color: {{ $usuario->configuracao->texto_cor }} !important; 
                    text-shadow: 2px 0 {{ $usuario->configuracao->borda_texto_cor }}, -2px 0 {{ $usuario->configuracao->borda_texto_cor }}, 0 2px {{ $usuario->configuracao->borda_texto_cor }}, 0 -2px {{ $usuario->configuracao->borda_texto_cor }},
                    1px 1px {{ $usuario->configuracao->borda_texto_cor }}, -1px -1px {{ $usuario->configuracao->borda_texto_cor }}, 1px -1px {{ $usuario->configuracao->borda_texto_cor }}, -1px 1px {{ $usuario->configuracao->borda_texto_cor }} !important;" @endif
                    href="?posts">
                    {{ count($usuario->memes) }} 
                    <br> 
                    Posts
                </a>
                <a class="mx-5 link-abas" @if($usuario->configuracao) style="color: {{ $usuario->configuracao->texto_cor }} !important; 
                    text-shadow: 2px 0 {{ $usuario->configuracao->borda_texto_cor }}, -2px 0 {{ $usuario->configuracao->borda_texto_cor }}, 0 2px {{ $usuario->configuracao->borda_texto_cor }}, 0 -2px {{ $usuario->configuracao->borda_texto_cor }},
                    1px 1px {{ $usuario->configuracao->borda_texto_cor }}, -1px -1px {{ $usuario->configuracao->borda_texto_cor }}, 1px -1px {{ $usuario->configuracao->borda_texto_cor }}, -1px 1px {{ $usuario->configuracao->borda_texto_cor }}; !important" @endif
                    href="?seguidores">
                    {{ count($usuario->seguidores) }} 
                    <br> 
                    Seguidores
                </a>
                <a class="mx-5 link-abas" @if($usuario->configuracao) style="color: {{ $usuario->configuracao->texto_cor }} !important; 
                    text-shadow: 2px 0 {{ $usuario->configuracao->borda_texto_cor }}, -2px 0 {{ $usuario->configuracao->borda_texto_cor }}, 0 2px {{ $usuario->configuracao->borda_texto_cor }}, 0 -2px {{ $usuario->configuracao->borda_texto_cor }},
                    1px 1px {{ $usuario->configuracao->borda_texto_cor }}, -1px -1px {{ $usuario->configuracao->borda_texto_cor }}, 1px -1px {{ $usuario->configuracao->borda_texto_cor }}, -1px 1px {{ $usuario->configuracao->borda_texto_cor }} !important;" @endif
                    href="?seguindo">
                    {{ count($usuario->seguindo) }} 
                    <br> 
                    Seguindo
                </a>
            </div>
        </div>

        @if(isset($_GET["posts"]) || (!isset($_GET["posts"]) && !isset($_GET["seguidores"]) && !isset($_GET["seguindo"])))
            @component('layouts._components.perfil_posts', ['memes' => $memes, 'usuario' => $usuario])
            @endcomponent
        @elseif(isset($_GET["seguidores"]))
            @component('layouts._components.perfil_seguidores', ['seguidores' => $seguidores])
            @endcomponent
        @elseif(isset($_GET["seguindo"]))
            @component('layouts._components.perfil_seguindo', ['seguindos' => $seguindos])
            @endcomponent
        @endif
    </div>

    <script>
        function seguir(id) {
            $.ajax({
                type: "POST",
                url: "{{ route('seguir') }}",
                dataType: "json",
                data: {
                    "_token": "{{@csrf_token()}}",
                    "usuario_id": id
                },
                success: function() {
                    window.location.reload();
                }
            });
        }

        function deseguir(id) {
            $.ajax({
                type: "POST",
                url: "{{ route('deseguir') }}",
                dataType: "json",
                data: {
                    "_token": "{{@csrf_token()}}",
                    "usuario_id": id
                },
                success: function() {
                    window.location.reload();
                }
            });
        }
    </script>
@endsection