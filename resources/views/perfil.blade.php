@extends('layouts.basicLayout')

@section('titulo', 'MemeFun - Perfil')

@section('conteudo')
    <link rel="stylesheet" href="{{ asset('css/perfil.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/posts.css') }}"/>
    
    @php
        $banner = '';

        if(auth()->user()->banner != null) {
            $banner = config('app.url' ) . '/' . auth()->user()->banner;
        }
        else {
            $banner = "../images/fundoroxo.jpg";
        }
    @endphp
    <div class="container-fluid">
        <div id="banner" style="background-image: url({{ $banner }});"></div>
        <div class="mx-3 banner-info">
            @if(auth()->user() != null)
                <img src="{{ config('app.url'). '/' . auth()->user()->foto }}" class="rounded-circle" width="100px" heigth="100px">
            @else
                <img src="{{ asset('images/default-user.jpg') }}" class="rounded-circle" width="100px" heigth="100px">
            @endif
            <span class="font-weight-bold">{{ auth()->user()->name }}</span>
            <br>
            <div class="d-flex user-infos text-center">
                <a class="mx-5 link-abas" href="{{config('app.url')}}/perfil?posts">{{ count(auth()->user()->memes) }} <br> Posts</a>
                <a class="mx-5 link-abas" href="{{config('app.url')}}/perfil?seguidores">{{ count(auth()->user()->seguidores) }} <br> Seguidores</a>
                <a class="mx-5 link-abas" href="{{config('app.url')}}/perfil?seguindo">{{ count(auth()->user()->seguindo) }} <br> Seguindo</a>
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