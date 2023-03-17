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
        <div id="banner" style="background-image: url({{ $banner }});"></div>
        <div class="mx-3 banner-info">
            @if($usuario != null)
                <img src="{{ config('app.url'). '/' . $usuario->foto }}" class="rounded-circle" width="100px" heigth="100px">
            @else
                <img src="{{ asset('images/default-user.jpg') }}" class="rounded-circle" width="100px" heigth="100px">
            @endif
            <span class="font-weight-bold link-perfil">{{ $usuario->name }}</span>
            <br>
            <div class="d-flex user-infos text-center">
                <a class="mx-5 link-abas" href="?posts">{{ count($usuario->memes) }} <br> Posts</a>
                <a class="mx-5 link-abas" href="?seguidores">{{ count($usuario->seguidores) }} <br> Seguidores</a>
                <a class="mx-5 link-abas" href="?seguindo">{{ count($usuario->seguindo) }} <br> Seguindo</a>
            </div>
        </div>

        @if(isset($_GET["posts"]) || (!isset($_GET["posts"]) && !isset($_GET["seguidores"]) && !isset($_GET["seguindo"])))
            @component('layouts._components.perfil_posts', ['memes' => $memes, 'usuario' => $usuario])
            @endcomponent
        @elseif(isset($_GET["seguidores"]))
            @component('layouts._components.perfil_seguidores', ['usuario' => $usuario])
            @endcomponent
        @elseif(isset($_GET["seguindo"]))
            @component('layouts._components.perfil_seguindo', ['usuario' => $usuario])
            @endcomponent
        @endif
    </div>
@endsection