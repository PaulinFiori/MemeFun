@extends('layouts.basicLayout')

@section('titulo', 'MemeFun - Editar Perfil')

@section('conteudo')
    <link rel="stylesheet" href="{{ asset('css/editarperfil.css') }}"/>
    <script type="text/javascript" src="{{ asset('js/editarperfil.js') }}"></script>

    <div class="container d-flex justify-content-center align-items-center text-center mt-3">
        <form method="POST" action="" class="login100-form validate-form" enctype="multipart/form-data">
            @csrf

            @if(auth()->user() != null)
                <img src="{{ config('app.url'). '/' . auth()->user()->foto }}" class="rounded-circle mb-3" width="100px" heigth="100px">
            @else
                <img src="{{ asset('images/default-user.jpg') }}" class="rounded-circle mb-3" width="100px" heigth="100px">
            @endif
            <br>

            <div class="wrap-input100">
                <input class="input100" type="file" name="foto">
                <span class="focus-input100" data-placeholder="Foto"></span>
            </div>

            <div class="wrap-input100">
                <input class="input100" type="file" name="banner">
                <span class="focus-input100" data-placeholder="Banner"></span>
            </div>

            <div class="wrap-input100 validate-input" data-validate="Digite um nome">
                <input class="input100" type="text" name="nome" value="{{ auth()->user()->name }}">
                <span class="focus-input100" data-placeholder="Nome"></span>
            </div>

            <div class="wrap-input100 validate-input" data-validate = "Email válido é: a@b.c">
                <input class="input100" type="text" name="email" value="{{ auth()->user()->email }}">
                <span class="focus-input100" data-placeholder="Email"></span>
            </div>

            <div class="wrap-input100">
                <span class="btn-show-pass">
                    <iconify-icon icon="zmdi:eye"></iconify-icon>
                </span>
                <input class="input100" type="password" name="password">
                <span class="focus-input100" data-placeholder="Password"></span>
            </div>

            <div class="container-login100-form-btn mb-5">
                <div class="wrap-login100-form-btn">
                    <div class="login100-form-bgbtn"></div>
                    <button type="submit" class="login100-form-btn">
                        Salvar
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection