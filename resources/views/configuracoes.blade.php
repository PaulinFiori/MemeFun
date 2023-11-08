@extends('layouts.basicLayout')

@section('titulo', 'MemeFun - Configurações')

@section('conteudo')
    <link rel="stylesheet" href="{{ asset('css/configuracoes.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/checkbox.css') }}"/>

    <div class="container mt-3 mb-3">
        <div class="mb-3">
            <label>Modo Escuro</label>
            <label class="switch">
                <input type="checkbox" id="dark_mode" @if( auth()->user()->configuracao->modo_escuro == 1) checked @endif>
                <span class="slider round"></span>
            </label>
        </div>

        <div class="mb-3">
            <p>Cor do texto no perfil</p>
            <div class="d-flex">
                <div id="corblack" class="div-color black cursor-pointer {{ auth()->user()->configuracao->texto_cor == 'black' ? 'texto-active' : '' }}" onclick="mudarCorTexto('black')"></div>
                <div id="corwhite" class="div-color white cursor-pointer {{ auth()->user()->configuracao->texto_cor == 'white' ? 'texto-active' : '' }}" onclick="mudarCorTexto('white')"></div>
                <div id="coryellow" class="div-color yellow cursor-pointer {{ auth()->user()->configuracao->texto_cor == 'yellow' ? 'texto-active' : '' }}" onclick="mudarCorTexto('yellow')"></div>
                <div id="corred" class="div-color red cursor-pointer {{ auth()->user()->configuracao->texto_cor == 'red' ? 'texto-active' : '' }}" onclick="mudarCorTexto('red')"></div>
                <div id="corgreen" class="div-color green cursor-pointer {{ auth()->user()->configuracao->texto_cor == 'green' ? 'texto-active' : '' }}" onclick="mudarCorTexto('green')"></div>
                <div id="corblue" class="div-color blue cursor-pointer {{ auth()->user()->configuracao->texto_cor == 'blue' ? 'texto-active' : '' }}" onclick="mudarCorTexto('blue')"></div>
            </div>
        </div>

        <div class="mb-3">
            <p>Cor da borda do texto no perfil</p>
            <div class="d-flex">
                <div id="corbordablack" class="div-color black cursor-pointer {{ auth()->user()->configuracao->borda_texto_cor == 'black' ? 'borda-active' : '' }}" onclick="mudarCorBordaTexto('black')"></div>
                <div id="corbordawhite" class="div-color white cursor-pointer {{ auth()->user()->configuracao->borda_texto_cor == 'white' ? 'borda-active' : '' }}" onclick="mudarCorBordaTexto('white')"></div>
                <div id="corbordayellow" class="div-color yellow cursor-pointer {{ auth()->user()->configuracao->borda_texto_cor == 'yellow' ? 'borda-active' : '' }}" onclick="mudarCorBordaTexto('yellow')"></div>
                <div id="corbordared" class="div-color red cursor-pointer {{ auth()->user()->configuracao->borda_texto_cor == 'red' ? 'borda-active' : '' }}" onclick="mudarCorBordaTexto('red')"></div>
                <div id="corbordagreen" class="div-color green cursor-pointer {{ auth()->user()->configuracao->borda_texto_cor == 'green' ? 'borda-active' : '' }}" onclick="mudarCorBordaTexto('green')"></div>
                <div id="corbordablue" class="div-color blue cursor-pointer {{ auth()->user()->configuracao->borda_texto_cor == 'blue' ? 'borda-active' : '' }}" onclick="mudarCorBordaTexto('blue')"></div>
            </div>
        </div>

        <div id="botoes" class="d-none">
            <button type="button" class="btn btn-primary" onclick="salvarConfiguracoes()">Salvar Alterações</button>
            <button type="button" class="btn btn-secondary" onclick="window.location.reload()">Cancelar</button>
        </div>
    </div>

    <script>
        let corTexto = null;
        let corBordaTexto = null;

        function salvarConfiguracoes() {
            $.ajax({
                type: "POST",
                url: "{{ route('salvar-configuracoes') }}",
                dataType: "json",
                data: {
                    "_token": "{{@csrf_token()}}",
                    "dark_mode": $("#dark_mode:checked").val() ? "on" : "off",
                    "corTexto": corTexto,
                    "bordaTexto": corBordaTexto
                },
                success: function() {
                    window.location.reload();
                }
            });
        }

        function mudarCorTexto(cor) {
            corTexto = cor;
            id = "#cor" + cor;
            $(".texto-active").removeClass("texto-active");
            $(id).addClass("texto-active");

            if((corBordaTexto != null && corBordaTexto != '{{ auth()->user()->configuracao->borda_texto_cor }}') 
                || (corTexto != null && corTexto != '{{ auth()->user()->configuracao->texto_cor }}')) {
                $("#botoes").removeClass("d-none");
            } else {
                $("#botoes").addClass("d-none");
            }
        }

        function mudarCorBordaTexto(cor) {
            corBordaTexto = cor;
            id = "#corborda" + cor;
            $(".borda-active").removeClass("borda-active");
            $(id).addClass("borda-active");

            if((corBordaTexto != null && corBordaTexto != '{{ auth()->user()->configuracao->borda_texto_cor }}') 
                || (corTexto != null && corTexto != '{{ auth()->user()->configuracao->texto_cor }}')) {
                $("#botoes").removeClass("d-none");
            } else {
                $("#botoes").addClass("d-none");
            }
        }

        $('#dark_mode').click(function() {
            $("#txtAge").toggle(this.checked);
            if(this.checked != '{{ auth()->user()->configuracao->modo_escuro }}') {
                $("#botoes").removeClass("d-none");
            } else {
                $("#botoes").addClass("d-none");
            }
        });
    </script>
@endsection