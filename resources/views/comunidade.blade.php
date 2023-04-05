@extends('layouts.basicLayout')

@section('titulo', 'MemeFun - Comunidade')

@section('conteudo')
    <link rel="stylesheet" href="{{ asset('css/comunidade.css') }}"/>

    <div class="container mt-3">
        <div class="row mb-5">
            <div class="filter shadow-lg bg-white float-right d-flex align-items-center justify-content-center">
                <span>Top</span>
                <div class="dropdown">
                    <button class="btn btn-flat btn-flat-icon" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-filter"></i>
                    </button>
                    <div class="dropdown-menu dropdown-scale dropdown-menu-right" role="menu" style="position: absolute; transform: translate3d(-136px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <a class="dropdown-item" href="#">Top</a>
                        <a class="dropdown-item" href="#">Últimas</a>
                        <a class="dropdown-item" href="#">Seguidores</a>
                    </div>
                </div>
            </div>
        </div>

        @foreach ($posts as $post)
            <div class="row mb-5">
                <div class="cardbox shadow-lg bg-white">
                    <!-- start cardbox-heading -->
                    <div class="cardbox-heading">
                        <div class="dropdown float-right">
                            <button class="btn btn-flat btn-flat-icon" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <em class="fa fa-ellipsis-h"></em>
                            </button>
                            <div class="dropdown-menu dropdown-scale dropdown-menu-right" role="menu" style="position: absolute; transform: translate3d(-136px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">
                                @auth
                                    @if(auth()->user()->tipo == "A" || $post->user_id == auth()->user()->id)
                                        <a class="dropdown-item" href="#">Excluir</a>
                                    @endif
                                @endauth
                                <a class="dropdown-item" href="#">Reportar</a>
                            </div>
                        </div>
                        <div class="media m-0">
                            <div class="d-flex mr-3 cursor-pointer">
                                <img class="img-fluid rounded-circle" src="{{ $post->usuario->foto }}" alt="User" onclick="window.location.href = '{{ config('app.url') . '/perfil/' . $post->usuario->id }}'">
                            </div>
                            <div class="media-body">
                                <p class="m-0 cursor-pointer" onclick="window.location.href = '{{ config('app.url') . '/perfil/' . $post->usuario->id }}'">{{ $post->usuario->name }}</p>
                                <small>
                                    <span>
                                        <i class="icon ion-md-time"></i>
                                        {{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}
                                    </span>
                                </small>
                            </div>
                        </div>
                        <!--/ cardbox-heading -->

                        <!--start cardbox-item -->
                        <div class="cardbox-item">
                            <p>{{ $post->titulo }}<p>
                        </div>

                        @if($post->anexo != null)
                            @if($post->extensao == 'jpeg' || $post->extensao == 'Webp' || $post->extensao == 'png' || $post->extensao == 'jpg')
                                <div class="cardbox-item">
                                    <img class="img-fluid" src="{{ $post->anexo }}" alt="Image">
                                </div>
                            @else
                                <div class="cardbox-item">
                                    <video width="100%" height="500px" controls>
                                        <source src="{{ config('app.url') . '/' . $post->anexo }}">
                                    </video>
                                </div>
                            @endif
                        @endif

                        <div class="cardbox-item">
                            <p>{{ $post->descricao }}<p>
                        </div>
                        <!--/ cardbox-item -->

                        <!-- start cardbox-base -->
                        <div class="cardbox-base">
                            <ul class="float-right">
                                <li onclick="verComentario('comentarios-{{$post->id}}')">
                                    <a>
                                        <i class="fa fa-comments"></i>
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <em class="mr-2-rem">{{ count($post->comentarios) }}</em>
                                    </a>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <a>
                                        <i class="fa fa-thumbs-up"></i>
                                        <span class="ml-menus-5-percent">{{ count($post->curtidas) }} Curtida(s)</span>
                                    </a>
                                </li>
                            </ul>	
                            <ul>
                                <li>
                                    <a>
                                        <i class="fa fa-thumbs-down"></i>
                                        <span class="ml-menus-5-percent">{{ count($post->naoCurtidas) }} Não Curtida(s)</span>
                                    </a>
                                </li>
                            </ul>		   
                        </div>
                        <!--/ cardbox-base -->

                        <!--start cardbox-like -->
                        <div class="cardbox-comments d-none" id="comentarios-{{$post->id}}">
                            <!--start comments -->
                            @if(count($post->comentarios) > 0)
                                @foreach ($post->comentarios as $comentario)
                                    <div class="d-flex mb-3">
                                        <span class="comment-avatar float-left">
                                            <a>
                                                <img class="rounded-circle" src="{{ $comentario->usuario->foto }}" alt="...">
                                            </a>                            
                                        </span>
                                        <div class="comment me-3 float-right mt-10">
                                            <span>
                                                {{ $comentario->usuario->descricao }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            <!--/ comments -->
                            
                            <span class="comment-avatar float-left">
                                <a>
                                    @if(auth()->user() != null)
                                        <img class="rounded-circle" src="{{ auth()->user()->foto }}" alt="...">
                                    @else
                                        <img class="rounded-circle" src="{{ asset('images/default-user.jpg') }}" alt="...">
                                    @endif
                                </a>                            
                            </span>
                            <!--start Search -->
                            <div class="search">
                                <input placeholder="Deixe um comentário" type="text">
                                <button>
                                    <i class="fa-solid fa-paper-plane"></i>
                                </button>
                            </div>
                            <!--/. Search -->
                        </div>
                        <!--/ cardbox-like -->
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div>
        <a class="new-post" href="{{route('novo-post-comunidade')}}">
            <i class="fa-solid fa-paper-plane"></i>
        </a>
    </div>
@endsection