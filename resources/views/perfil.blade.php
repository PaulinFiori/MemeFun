@extends('layouts.basicLayout')

@section('titulo', 'MemeFun - Perfil')

@section('conteudo')
    <link rel="stylesheet" href="{{ asset('css/perfil.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/posts.css') }}"/>
    
    <div class="container-fluid">
        <div id="banner"></div>
        <div class="mx-3 banner-info">
            <img src="{{ asset('images/default-user.jpg') }}" class="rounded-circle" width="100px" heigth="100px">
            <span class="text-white">Fulano</span>
            <br>
            <div class="d-flex text-white user-infos text-center">
                <a class="mx-5 link-abas" href="{{config('app.url')}}/perfil?posts">0 <br> Posts</a>
                <a class="mx-5 link-abas" href="{{config('app.url')}}/perfil?seguidores">6 <br> Seguidores</a>
                <a class="mx-5 link-abas" href="{{config('app.url')}}/perfil?seguindo">20 <br> Seguindo</a>
            </div>
        </div>

        @if(isset($_GET["posts"]) || (!isset($_GET["posts"]) && !isset($_GET["seguidores"]) && !isset($_GET["seguindo"])))
            @component('layouts._components.perfil_posts')
            @endcomponent
        @elseif(isset($_GET["seguidores"]))
            @component('layouts._components.perfil_seguidores')
            @endcomponent
        @elseif(isset($_GET["seguindo"]))
            @component('layouts._components.perfil_seguindo')
            @endcomponent
        @endif
    </div>
@endsection