@extends('layouts.basicLayout')

@section('titulo', 'MemeFun - Feed')

@section('conteudo')
    <link rel="stylesheet" href="{{ asset('css/posts.css') }}"/>

    <div class="container mt-3">
        @foreach ($memes as $meme)
            <div class="row mb-5">
                <div class="col-lg-6 offset-lg-3">
                    <div class="cardbox shadow-lg bg-white">
                        <!-- start cardbox-heading -->
                        <div class="cardbox-heading">
                            <div class="dropdown float-right">
                                <button class="btn btn-flat btn-flat-icon" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <em class="fa fa-ellipsis-h"></em>
                                </button>
                                <div class="dropdown-menu dropdown-scale dropdown-menu-right" role="menu" style="position: absolute; transform: translate3d(-136px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">
                                    @auth
                                        @if(auth()->user()->tipo == "A" || $meme->user_id == auth()->user()->id)
                                            <a class="dropdown-item" href="#">Excluir</a>
                                        @endif
                                    @endauth
                                    <a class="dropdown-item" href="#">Reportar</a>
                                </div>
                            </div>
                            <div class="media m-0">
                                <div class="d-flex mr-3 cursor-pointer">
                                    <img class="img-fluid rounded-circle" src="{{ $meme->usuario->foto }}" alt="User" onclick="window.location.href = '{{ config('app.url') . '/perfil/' . $meme->usuario->id }}'">
                                </div>
                                <div class="media-body">
                                    <p class="m-0 cursor-pointer" onclick="window.location.href = '{{ config('app.url') . '/perfil/' . $meme->usuario->id }}'">{{ $meme->usuario->name }}</p>
                                    <small>
                                        <span>
                                            <i class="icon ion-md-time"></i>
                                            {{ \Carbon\Carbon::parse($meme->created_at)->diffForHumans() }}
                                        </span>
                                    </small>
                                </div>
                            </div>
                            <!--/ cardbox-heading -->

                            <!--start cardbox-item -->
                            <div class="cardbox-item">
                                <p>{{ $meme->titulo }}<p>
                            </div>

                            <div class="cardbox-item">
                                <img class="img-fluid" src="{{ $meme->anexo }}" alt="Image">
                            </div>

                            <div class="cardbox-item">
                                <p>{{ $meme->descricao }}<p>
                            </div>
                            <!--/ cardbox-item -->

                            <!-- start cardbox-base -->
                            <div class="cardbox-base">
                                <ul class="float-right">
                                    <li onclick="verComentario('comentarios-{{$meme->id}}')">
                                        <a>
                                            <i class="fa fa-comments"></i>
                                        </a>
                                    </li>
                                    <li onclick="verComentario('comentarios-{{$meme->id}}')">
                                        <a>
                                            <em class="mr-2-rem">{{ count($meme->comentarios) }}</em>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <i class="fa fa-share-alt"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <i class="fa-solid fa-circle-down no-margin-right"></i>
                                        </a>
                                    </li>
                                </ul>
                                <ul>
                                    <li>
                                        <a>
                                            <i class="fa fa-thumbs-up"></i>
                                            <span class="ml-menus-5-percent">{{ count($meme->curtidas) }} Curtida(s)</span>
                                        </a>
                                    </li>
                                </ul>			   
                            </div>
                            <!--/ cardbox-base -->

                            <!--start cardbox-like -->
                            <div class="cardbox-comments d-none" id="comentarios-{{$meme->id}}">
                                <!--start comments -->
                                @if(count($meme->comentarios) > 0)
                                    @foreach ($meme->comentarios as $comentario)
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
            </div>
        @endforeach
    </div>
@endsection