@extends('layouts.basicLayout')

@section('titulo', 'MemeFun - Feed')

@section('conteudo')
    <link rel="stylesheet" href="{{ asset('css/posts.css') }}"/>

    <div class="navbar-top d-flex d-lg-none justify-content-center align-items-center">
        <div class="dropdown">
            <a class="dropdown-toggle d-flex align-items-center hidden-arrow text-black" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Início
            </a>

            <div class="dropdown-menu dropwdown-meme">
                <a class="dropdown-item" href="{{route('home')}}">
                    Início
                </a>
                <a class="dropdown-item" href="{{route('melhores')}}">
                    Melhores
                </a>
                <a class="dropdown-item" href="{{route('seguidores')}}">
                    Seguindo
                </a>
            </div>
        </div>
    </div>

    <div class="container mt-3" id="memes-container">
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
                                            <a class="dropdown-item" onclick="excluirMeme({{ $meme->id }})">Excluir</a>
                                        @endif
                                    @endauth
                                    <a class="dropdown-item" onclick="reportarMeme({{ $meme->id }}, '{{ base64_encode($meme->id) }}')">Reportar</a>
                                </div>
                            </div>
                            <div class="media m-0">
                                <div class="d-flex mr-3 cursor-pointer">
                                    @if($meme->usuario->foto != null)
                                        <img class="img-fluid rounded-circle" src="{{ config('app.url') . '/' . $meme->usuario->foto }}" alt="User" onclick="window.location.href = '{{ config('app.url') . '/perfil/' . base64_encode($meme->usuario->id) }}'">
                                    @else
                                        <img class="img-fluid rounded-circle" src="{{ asset('images/default-user.jpg') }}" alt="User" onclick="window.location.href = '{{ config('app.url') . '/perfil/' . base64_encode($meme->usuario->id) }}'">
                                    @endif
                                </div>
                                <div class="media-body">
                                    <p class="m-0 cursor-pointer" onclick="window.location.href = '{{ config('app.url') . '/perfil/' . base64_encode($meme->usuario->id) }}'">{{ $meme->usuario->name }}</p>
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

                            @if($meme->extensao == 'jpeg' || $meme->extensao == 'webp' || $meme->extensao == 'png' || $meme->extensao == 'jpg')
                                <div class="cardbox-item">
                                    <img class="img-fluid" src="{{ config('app.url') . '/' . $meme->anexo }}" alt="Image">
                                </div>
                            @else
                                <div class="cardbox-item">
                                    <video width="100%" height="500px" controls>
                                        <source src="{{ config('app.url') . '/' . $meme->anexo }}">
                                    </video>
                                </div>
                            @endif

                            <div class="cardbox-item">
                                <p>{{ $meme->descricao }}<p>
                            </div>
                            <!--/ cardbox-item -->

                            <!-- start cardbox-base -->
                            @php
                                $curtiuMeme = false;
                                if(auth()->user() != null) {
                                    foreach ($meme->curtidas as $curtida) {
                                        if($curtida->user_id == auth()->user()->id) {
                                            $curtiuMeme = true;
                                            break;
                                        }
                                    }
                                }
                            @endphp
                            <div class="cardbox-base">
                                <ul class="float-right">
                                    <li onclick="verComentario('comentarios-{{$meme->id}}')">
                                        <a class="cursor-pointer">
                                            <i class="fa fa-comments"></i>
                                        </a>
                                    </li>
                                    <li onclick="verComentario('comentarios-{{$meme->id}}')">
                                        <a class="cursor-pointer">
                                            <em class="mr-2-rem">{{ count($meme->comentarios) }}</em>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="cursor-pointer clipb" data-clipboard-text="{{ config('app.url')}}/meme/{{ base64_encode($meme->id) }}">
                                            <i class="fa fa-share-alt"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="cursor-pointer" href="{{ config('app.url')}}/baixarMeme/{{ base64_encode($meme->id) }}">
                                            <i class="fa-solid fa-circle-down no-margin-right"></i>
                                        </a>
                                    </li>
                                </ul>
                                <ul>
                                    <li>
                                        <a class="cursor-pointer" onclick="curtiMeme('{{base64_encode($meme->id)}}')">
                                            <i class="fa fa-thumbs-up {{$curtiuMeme ? 'text-primary' : '' }}"></i>
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
                                        <div class="mb-3">
                                            @if($comentario->id_comentario_meme == null)
                                                <div class="d-flex">
                                                    <span class="comment-avatar float-left">
                                                        <a>
                                                            <img class="rounded-circle" src="{{ $comentario->usuario->foto }}" alt="...">
                                                        </a>                            
                                                    </span>
                                                    <div class="comment me-3 float-right mt-10">
                                                        <div class="name-comment">
                                                            {{ $comentario->usuario->name }}
                                                        </div>
                                                        <span>
                                                            {{ $comentario->descricao }}
                                                        </span>
                                                        <div>
                                                            <span class="reply-comment" onclick="showResponderComentario({{$comentario->id}}, {{$meme->id}}, '{{$comentario->descricao}}')">Responder</span>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <button class="btn btn-flat btn-flat-icon btn-comment" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <em class="fa fa-ellipsis-vertical"></em>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-scale dropdown-menu-right" role="menu" style="position: absolute; transform: translate3d(-136px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                            @auth
                                                                @if(auth()->user()->tipo == "A" || $comentario->usuario->id == auth()->user()->id)
                                                                    <a class="dropdown-item" onclick="excluirComentarioMeme({{$comentario->id}})">Excluir</a>
                                                                @endif
                                                            @endauth
                                                            <a class="dropdown-item" onclick="reportarComentarioMeme({{$comentario->id}}, '{{ base64_encode($comentario->meme->id)}}')">Reportar</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            <!--start reply comments -->
                                            @if(count($comentario->comentarios) > 0 )
                                                @foreach ($comentario->comentarios as $comentarioFilho)
                                                    <div class="d-flex mb-3 ml-4">
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
                                                                <span class="reply-comment" onclick="showResponderComentario({{$comentarioFilho->id}}, {{$meme->id}}, '{{$comentarioFilho->descricao}}')">Responder</span>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <button class="btn btn-flat btn-flat-icon btn-comment" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <em class="fa fa-ellipsis-vertical"></em>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-scale dropdown-menu-right" role="menu" style="position: absolute; transform: translate3d(-136px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                                @auth
                                                                    @if(auth()->user()->tipo == "A" || $comentarioFilho->usuario->id == auth()->user()->id)
                                                                        <a class="dropdown-item" onclick="excluirComentarioMeme({{$comentarioFilho->id}})">Excluir</a>
                                                                    @endif
                                                                @endauth
                                                                <a class="dropdown-item" onclick="reportarComentarioMeme({{$comentarioFilho->id}}, '{{ base64_encode($comentarioFilho->meme->id) }}')">Reportar</a>
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
                                    <span class="reply-comment-input d-none" id="reply-comment-input-{{$meme->id}}">
                                    </span>
                                    <input type="hidden" name="id" id="id" value="{{ $meme->id }}">
                                    <input placeholder="Deixe um comentário" type="text" name="comentario-{{ $meme->id }}" id="comentario-{{ $meme->id }}">
                                    <button type="button" id="button-send-comment-{{ $meme->id }}" class="" onclick="comentarMeme({{ $meme->id }})">
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

        <div class="d-none">
            {{ $memes->links() }}
        </div>
    </div>

    <script>
        let comentarioResponder = null;

        $(document).ready(function() {
            var clipboard = new ClipboardJS(".clipb");
            clipboard.on("success", function(e) {
                toastr.info('Agora é so compartilhar.', 'Copiado com sucesso!');
                e.clearSelection();
            });

            let nextPageUrl = '{{ $memes->nextPageUrl() }}';
            $(window).scroll(function () {
                if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
                    if (nextPageUrl) {
                        loadMoreMemes();
                    }
                }
            });

            function loadMoreMemes() {
                $.ajax({
                    url: nextPageUrl,
                    type: 'get',
                    beforeSend: function () {
                        nextPageUrl = '';
                    },
                    success: function (data) {
                        nextPageUrl = data.nextPageUrl;
                        $('#memes-container').append(data.view);
                    },
                    error: function (xhr, status, error) {
                        console.error("Erro ao carregar mais memes:", error);
                    }
                });
            }
        });

        function curtiMeme(id) {
            $.ajax({
                type: "POST",
                url: "{{ route('curtiMeme') }}",
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

        function baixarMeme(id) {
            $.ajax({
                type: "GET",
                url: "{{ route('baixarMeme') }}",
                dataType: "json",
                data: {
                    "_token": "{{@csrf_token()}}",
                    "id": id
                },
                success: function() {
                }
            });
        }

        function comentarMeme(id) {
            let input = "#comentario-" + id;
            if($(input).val() != '') {
                $.ajax({
                    type: "POST",
                    url: "{{ route('comentarMeme') }}",
                    dataType: "json",
                    data: {
                        "_token": "{{@csrf_token()}}",
                        "id": id,
                        'comentario': $(input).val(),
                        'id_comentario_meme': comentarioResponder
                    },
                    success: function() {
                        window.location.reload();
                    }
                });
            } else {
                toastr.error('Para comentar digite algo.', 'Erro!');
            }
        }

        function excluirMeme(id) {
            $.ajax({
                type: "POST",
                url: "{{ route('excluirMeme') }}",
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

        function reportarMeme(id, memeId) {
            $.ajax({
                type: "POST",
                url: "{{ route('reportarMeme') }}",
                dataType: "json",
                data: {
                    "_token": "{{@csrf_token()}}",
                    "id": id,
                    "meme_id": memeId
                },
                success: function() {
                    window.location.reload();
                }
            });
        }

        function showResponderComentario(id, memeId, texto) {
            comentarioResponder = id;
            let respoderinput = "#reply-comment-input-" + memeId;
            let responderButton = "#button-send-comment-" + memeId;
            $(respoderinput).html("Respondendo: " + texto.substring(0, 9) + "..." +
                "<button class='btn btn-flat btn-flat-icon-close' type='button' aria-expanded='false' onclick='unshowResponderComentario(" + memeId + ")'>" +
                    "<i class='fa-solid fa-xmark'></i>" +
                "</button>");
            $(respoderinput).removeClass("d-none");
            $(responderButton).addClass("mt-24");
        }

        function unshowResponderComentario(id) {
            comentarioResponder = null;
            let respoderinput = "#reply-comment-input-" + id;
            let responderButton = "#button-send-comment-" + id;
            $(respoderinput).addClass("d-none");
            $(responderButton).removeClass("mt-24");
        }

        function excluirComentarioMeme(id) {
            $.ajax({
                type: "POST",
                url: "{{ route('excluirComentario') }}",
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

        function reportarComentarioMeme(id, memeId) {
            $.ajax({
                type: "POST",
                url: "{{ route('reportarComentario') }}",
                dataType: "json",
                data: {
                    "_token": "{{@csrf_token()}}",
                    "id": id,
                    "meme_id": memeId
                },
                success: function() {
                    window.location.reload();
                }
            });
        }
    </script>
@endsection