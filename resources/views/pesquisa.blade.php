@extends('layouts.basicLayout')

@section('titulo', 'MemeFun - Pesquisa')

@section('conteudo')
    <link rel="stylesheet" href="{{ asset('css/pesquisa.css') }}"/>

    <div class="container-fluid mt-3 mb-3 d-flex d-lg-none">
        <input id="buscaPagina" class="form-control me-2" type="search" name="busca" placeholder="Procurar memes ou usuários" aria-label="Search">
        <button class="btn btn-outline-success" type="button" onclick="pesquisaPagina()">Procurar</button>
    </div>

    <div class="container-fluid mt-3 mb-3 pesquisa">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link {{ !isset($_GET["tab"]) || (isset($_GET["tab"]) && $_GET["tab"] == "memes") ? 'active' : '' }}" aria-current="page" href="?tab=memes">Memes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ isset($_GET["tab"]) && $_GET["tab"] == "posts" ? 'active' : '' }}" href="?tab=posts">Posts</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ isset($_GET["tab"]) && $_GET["tab"] == "contas" ? 'active' : '' }}" href="?tab=contas">Contas</a>
            </li>
        </ul>

        @if(!isset($_GET["tab"]) || (isset($_GET["tab"]) && $_GET["tab"] == "memes"))
            @if(isset($memes))
                @if(count($memes) > 0)
                    @foreach ($memes as $meme)
                        <div class="row mt-1 pesquisa-dark">
                            <div class="col-2 col-sm-2 col-md-2 col-lg-2 heigth-120 mb-1">
                                @if($meme->extensao == 'jpeg' || $meme->extensao == 'webp' || $meme->extensao == 'png' || $meme->extensao == 'jpg')
                                    <img class="img-fluid img-pesquisa" src="{{ config('app.url') . '/' . $meme->anexo }}" alt="Image">
                                @else
                                    <video width="100%" height="100%">
                                        <source src="{{ config('app.url') . '/' . $meme->anexo }}">
                                    </video>
                                @endif
                            </div>
                            <div class="col-10 col-sm-10 col-md-10 col-lg-10 mb-1">
                                <p class="font-weight-bold">Título: {{ $meme->titulo }}</p>
                                <p>Descrição: {{ $meme->descricao }}</p>
                                <a class="link" href="{{ config('app.url')}}/meme/{{ base64_encode($meme->id) }}">
                                    Ir para o meme
                                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                </a>
                            </div>
                            <hr>
                        </div>
                    @endforeach

                    <div class="float-right">
                        {{ $memes->links() }}
                    </div>
                @else
                    <div class="alert alert-secondary mt-3" role="alert">
                        Sem memes para essa pesquisa!
                    </div>
                @endif
            @else
                <div class="alert alert-secondary mt-3" role="alert">
                    Sem memes para essa pesquisa!
                </div>
            @endif
        @elseif(isset($_GET["tab"]) && $_GET["tab"] == "posts")
            @if(isset($posts))
                @if(count($posts) > 0)
                    @foreach ($posts as $post)
                        <div class="row mt-1 pesquisa-dark">
                            <div class="col-2 col-sm-2 col-md-2 col-lg-2 heigth-120 mb-1">
                                @if($post->extensao == 'jpeg' || $post->extensao == 'webp' || $post->extensao == 'png' || $post->extensao == 'jpg')
                                    <img class="img-fluid img-pesquisa" src="{{ config('app.url') . '/' . $post->anexo }}" alt="Image">
                                @else
                                    <video width="100%" height="100%">
                                        <source src="{{ config('app.url') . '/' . $post->anexo }}">
                                    </video>
                                @endif
                            </div>
                            <div class="col-10 col-sm-10 col-md-10 col-lg-10 mb-1">
                                <p class="font-weight-bold">Título: {{ $post->titulo }}</p>
                                <p>Descrição: {{ $post->descricao }}</p>
                                <a class="link" href="{{ config('app.url')}}/post/{{ base64_encode($post->id) }}">
                                    Ir para o post
                                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                </a>
                            </div>
                            <hr>
                        </div>
                    @endforeach

                    <div class="float-right">
                        {{ $posts->links() }}
                    </div>
                @else
                    <div class="alert alert-secondary mt-3" role="alert">
                        Sem posts para essa pesquisa!
                    </div>
                @endif
            @else
                <div class="alert alert-secondary mt-3" role="alert">
                    Sem posts para essa pesquisa!
                </div>
            @endif
        @elseif(isset($_GET["tab"]) && $_GET["tab"] == "contas")
            @if(isset($contas))
                @if(count($contas) > 0)
                    @foreach ($contas as $conta)
                        <div class="row mt-1 pesquisa-dark">
                            <div class="col-2 col-sm-1 col-md-1 col-lg-1 mb-1" >
                                @if($conta->foto != null)
                                    <img class="img-fluid rounded-circle img-pesquisa" src="{{ config('app.url') . '/' . $conta->foto }}" alt="Image">
                                @else
                                    <img class="img-fluid rounded-circle img-pesquisa" src="{{ asset('images/default-user.jpg') }}" alt="Image">
                                @endif
                            </div>
                            <div class="col-10 col-sm-11 col-md-11 col-lg-11 mb-1">
                                <p class="font-weight-bold">Nome: {{ $conta->name }}</p>
                                <a class="link" href="{{ config('app.url') . '/perfil/' . base64_encode($conta->id) }}">
                                    Ver perfil
                                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                </a>
                            </div>
                            <hr>
                        </div>
                    @endforeach

                    <div class="float-right">
                        {{ $contas->links() }}
                    </div>
                @else
                    <div class="alert alert-secondary mt-3" role="alert">
                        Sem contas para essa pesquisa!
                    </div>
                @endif
            @else
                <div class="alert alert-secondary mt-3" role="alert">
                    Sem contas para essa pesquisa!
                </div>
            @endif
        @endif
    </div>
@endsection

<script>
    function pesquisaPagina() {
        console.log($("#buscaPagina").val());
        let busca = $("#buscaPagina").val();

        window.location.href = "{{ route('pesquisa') }}/" + busca;
    }
</script>