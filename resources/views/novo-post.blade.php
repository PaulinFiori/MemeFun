@extends('layouts.basicLayout')

@section('titulo', 'MemeFun - Novo Post')

@section('conteudo')
    <link rel="stylesheet" href="{{ asset('css/novopost.css') }}"/>
    <script type="text/javascript" src="{{ asset('js/novopost.js') }}"></script>

    <div class="container d-flex justify-content-center align-items-center text-center mt-3 mb-3">
        <form method="POST" action="" class="login100-form validate-form modal-novo" enctype="multipart/form-data">
            @csrf

            <h1 class="mb-5">Novo Meme</h1>

            <div class="wrap-input100 validate-input" data-validate="Selecione uma imagem">
                <input class="input100" type="file" name="arquivo" accept="image/*, video/*">
                <span class="focus-input100"></span>
            </div>

            <div class="wrap-input100 validate-input" data-validate="Digite um título">
                <input class="input100" type="text" name="titulo">
                <span class="focus-input100" data-placeholder="Titulo"></span>
            </div>

            <div class="wrap-input100">
                <input class="input100" type="text" name="descricao">
                <span class="focus-input100" data-placeholder="Descrição"></span>
            </div>

            <div class="container-login100-form-btn">
                <div class="wrap-login100-form-btn">
                    <div class="login100-form-bgbtn"></div>
                    <button id="SalvarMeme" type="submit" class="login100-form-btn">
                        Salvar
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection