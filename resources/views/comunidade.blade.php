@extends('layouts.basicLayout')

@section('titulo', 'MemeFun - Comunidade')

@section('conteudo')
    <link rel="stylesheet" href="{{ asset('css/comunidade.css') }}"/>

    <div class="container mt-3">
        <div class="row mb-5">
            <div class="filter shadow-lg bg-white float-right d-flex align-items-center justify-content-center">
                @if(!isset($_GET['filtro']) || $_GET['filtro'] == "ultimas")
                    <span>Últimas</span>
                @elseif(isset($_GET['filtro']) && $_GET['filtro'] == "top")
                    <span>Top</span>
                @elseif(isset($_GET['filtro']) && $_GET['filtro'] == "seguindo")
                    <span>Seguindo</span>
                @endif
                <div class="dropdown">
                    <button class="btn btn-flat btn-flat-icon" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-filter"></i>
                    </button>
                    <div class="dropdown-menu dropdown-scale dropdown-menu-right" role="menu" style="position: absolute; transform: translate3d(-136px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <a class="dropdown-item" href="?filtro=top">Top</a>
                        <a class="dropdown-item" href="?filtro=ultimas">Últimas</a>
                        <a class="dropdown-item" href="?filtro=seguindo">Seguindo</a>
                    </div>
                </div>
            </div>
        </div>

        @if(count($posts) > 0)
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
                                            <a class="dropdown-item" onclick="excluirPost({{ $post->id }})">Excluir</a>
                                        @endif
                                    @endauth
                                    <a class="dropdown-item" onclick="reportarPost({{ $post->id }}, '{{ base64_encode($post->id) }}')">Reportar</a>
                                </div>
                            </div>
                            <div class="media m-0">
                                <div class="d-flex mr-3 cursor-pointer">
                                    <img class="img-fluid rounded-circle" src="{{ $post->usuario->foto }}" alt="User" onclick="window.location.href = '{{ config('app.url') . '/perfil/' . base64_encode($post->usuario->id) }}'">
                                </div>
                                <div class="media-body">
                                    <p class="m-0 cursor-pointer" onclick="window.location.href = '{{ config('app.url') . '/perfil/' . base64_encode($post->usuario->id) }}'">{{ $post->usuario->name }}</p>
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
                            @php
                                $curtiuPost = false;
                                $naoCurtiuPost = false;
                                if(auth()->user() != null) {
                                    foreach ($post->curtidas as $curtida) {
                                        if($curtida->user_id == auth()->user()->id) {
                                            $curtiuPost = true;
                                            break;
                                        }
                                    }

                                    foreach ($post->naoCurtidas as $naoCurtida) {
                                        if($naoCurtida->user_id == auth()->user()->id) {
                                            $naoCurtiuPost = true;
                                            break;
                                        }
                                    }
                                }
                            @endphp
                            <div class="cardbox-base">
                                <ul class="float-right cursor-pointer" onclick="verComentario('comentarios-{{$post->id}}')">
                                    <li>
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
                                <ul class="cursor-pointer">
                                    <li>
                                        <a onclick="curtiPost({{ $post->id }}, 1)">
                                            <i class="fa fa-thumbs-up {{$curtiuPost ? 'text-primary' : '' }}"></i>
                                            <span class="ml-menus-5-percent">{{ count($post->curtidas) }} Curtida(s)</span>
                                        </a>
                                    </li>
                                </ul>	
                                <ul class="cursor-pointer">
                                    <li>
                                        <a onclick="curtiPost({{ $post->id }}, 0)">
                                            <i class="fa fa-thumbs-down {{$naoCurtiuPost ? 'text-danger' : '' }}"></i>
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
                                        <div style="margin-left: -19%;">
                                            @if($comentario->id_comentario_post == null)
                                                <div class="d-flex mb-3 ml-4">
                                                    <span class="comment-avatar float-left">
                                                        @if(auth()->user() != null)
                                                            <img class="rounded-circle" src="{{ auth()->user()->foto }}" alt="...">
                                                        @else
                                                            <img class="rounded-circle" src="{{ asset('images/default-user.jpg') }}" alt="...">
                                                        @endif                    
                                                    </span>
                                                    <div class="comment me-3 float-right mt-10">
                                                        <div class="name-comment">
                                                            {{ $comentario->usuario->name }}
                                                        </div>
                                                        <span>
                                                            {{ $comentario->descricao }}
                                                        </span>
                                                        <div>
                                                            <span class="reply-comment" onclick="showResponderComentario({{$comentario->id}}, {{$post->id}}, '{{$comentario->descricao}}')">Responder</span>
                                                        </div>
                                                    </div>
                                                    <div class="mt-10">
                                                        <button class="btn btn-flat btn-flat-icon btn-comment" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <em class="fa fa-ellipsis-vertical"></em>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-scale dropdown-menu-right" role="menu" style="position: absolute; transform: translate3d(-136px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                            @auth
                                                                @if(auth()->user()->tipo == "A" || $comentario->usuario->id == auth()->user()->id)
                                                                    <a class="dropdown-item" onclick="excluirComentarioPost({{$comentario->id}})">Excluir</a>
                                                                @endif
                                                            @endauth
                                                            <a class="dropdown-item" onclick="reportarComentarioPost({{$comentario->id}}, '{{ base64_encode($comentario->post->id) }}')">Reportar</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            <!--start reply comments -->
                                                @if(count($comentario->comentarios) > 0 )
                                                    @foreach ($comentario->comentarios as $comentarioFilho)
                                                        <div class="d-flex mb-3 ml-50">
                                                            <span class="comment-avatar float-left">
                                                                <a>
                                                                    <img class="rounded-circle" src="{{ $comentarioFilho->usuario->foto }}" alt="...">
                                                                </a>                            
                                                            </span>
                                                            <div class="comment me-3 float-right mt-10">
                                                                <div class="name-comment">
                                                                    {{ $comentario->usuario->name }}
                                                                </div>
                                                                <span>
                                                                    {{ $comentarioFilho->descricao }}
                                                                </span>
                                                                <div>
                                                                    <span class="reply-comment" onclick="showResponderComentario({{$comentarioFilho->id}}, {{$post->id}}, '{{$comentarioFilho->descricao}}')">Responder</span>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <button class="btn btn-flat btn-flat-icon btn-comment" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <em class="fa fa-ellipsis-vertical"></em>
                                                                </button>
                                                                <div class="dropdown-menu dropdown-scale dropdown-menu-right" role="menu" style="position: absolute; transform: translate3d(-136px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                                    @auth
                                                                        @if(auth()->user()->tipo == "A" || $comentarioFilho->usuario->id == auth()->user()->id)
                                                                            <a class="dropdown-item" onclick="excluirComentarioPost({{$comentarioFilho->id}})">Excluir</a>
                                                                        @endif
                                                                    @endauth
                                                                    <a class="dropdown-item" onclick="reportarComentarioPost({{$comentarioFilho->id}}, '{{ base64_encode($comentarioFilho->post->id) }}')">Reportar</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            <!--/ reply comments -->
                                        </div>
                                    @endforeach
                                @endif
                                <!--/ comments -->
                                
                                <div class="cardbox-comments1">
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
                                        <span class="reply-comment-input d-none" id="reply-comment-input-{{$post->id}}"></span>
                                        <input type="hidden" name="id" id="id" value="{{ $post->id }}">
                                        <input placeholder="Deixe um comentário" type="text" name="comentario-{{ $post->id }}" id="comentario-{{ $post->id }}">
                                        <button type="button" id="button-send-comment-{{ $post->id }}" class="" onclick="comentarPost({{ $post->id }})">
                                            <i class="fa-solid fa-paper-plane"></i>
                                        </button>
                                    </div>
                                    <!--/. Search -->
                                </div>
                            </div>
                            <!--/ cardbox-like -->
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p class="font-weight-bold text-center mb-3 mt-3">Não há post aqui.</p>
        @endif
    </div>

    <div>
        <a class="new-post" href="{{route('novo-post-comunidade')}}">
            <i class="fa-solid fa-paper-plane"></i>
        </a>
    </div>

    <script>
        let comentarioResponder = null;
        
        function curtiPost(postId, curtida) {
            $.ajax({
                type: "POST",
                url: "{{ route('curti-post-comunidade') }}",
                dataType: "json",
                data: {
                    "_token": "{{@csrf_token()}}",
                    "id": postId,
                    "curtida": curtida
                },
                success: function() {
                    window.location.reload();
                }
            });
        }

        function showResponderComentario(id, postId, texto) {
            comentarioResponder = id;
            let respoderinput = "#reply-comment-input-" + postId;
            let responderButton = "#button-send-comment-" + postId;
            $(respoderinput).html("Respondendo: " + texto.substring(0, 9) + "..." +
                "<button class='btn btn-flat btn-flat-icon-close' type='button' aria-expanded='false' onclick='unshowResponderComentario(" + postId + ")'>" +
                    "<i class='fa-solid fa-xmark'></i>" +
                "</button>");
            $(respoderinput).removeClass("d-none");
            $(responderButton).addClass("mt-24");
            $(".search").addClass("mb-10");
        }

        function unshowResponderComentario(id) {
            comentarioResponder = null;
            let respoderinput = "#reply-comment-input-" + id;
            let responderButton = "#button-send-comment-" + id;
            $(respoderinput).addClass("d-none");
            $(responderButton).removeClass("mt-24");
            $(".search").removeClass("mb-10");
        }

        function comentarPost(id) {
            let input = "#comentario-" + id;
            if($(input).val() != '') {
                $.ajax({
                    type: "POST",
                    url: "{{ route('comentar-post-comunidade') }}",
                    dataType: "json",
                    data: {
                        "_token": "{{@csrf_token()}}",
                        "id": id,
                        'comentario': $(input).val(),
                        'id_comentario_post': comentarioResponder
                    },
                    success: function() {
                        window.location.reload();
                    }
                });
            } else {
                toastr.error('Para comentar digite algo.', 'Erro!');
            }
        }

        function reportarComentarioPost(id, postId) {
            $.ajax({
                type: "POST",
                url: "{{ route('reportar-comentario-comunidade') }}",
                dataType: "json",
                data: {
                    "_token": "{{@csrf_token()}}",
                    "id": id,
                    "post_id": postId
                },
                success: function() {
                    window.location.reload();
                }
            });
        }

        function excluirComentarioPost(id) {
            $.ajax({
                type: "POST",
                url: "{{ route('excluir-comentario-comunidade') }}",
                dataType: "json",
                data: {
                    "_token": "{{@csrf_token()}}",
                    "id": id
                },
                success: function() {
                    window.location.reload();
                }
            });
        }

        function reportarPost(id, postId) {
            $.ajax({
                type: "POST",
                url: "{{ route('reportar-post-comunidade') }}",
                dataType: "json",
                data: {
                    "_token": "{{@csrf_token()}}",
                    "id": id,
                    "post_id": postId
                },
                success: function() {
                    window.location.reload();
                }
            });
        }

        function excluirPost(id) {
            $.ajax({
                type: "POST",
                url: "{{ route('excluir-post-comunidade') }}",
                dataType: "json",
                data: {
                    "_token": "{{@csrf_token()}}",
                    "id": id
                },
                success: function() {
                    window.location.reload();
                }
            });
        }
    </script>
@endsection