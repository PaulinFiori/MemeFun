@extends('layouts.basicLayout')

@section('titulo', 'MemeFun - Configurações')

@section('conteudo')
    <link rel="stylesheet" href="{{ asset('css/configuracoes.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/checkbox.css') }}"/>
    @vite(['resources/sass/checkbox.scss'])

    <div class="container mt-3">
        <form method="POST" action="">
            @csrf

            <div class="mb-3">
                <label class="switch">
                    <input type="checkbox">
                    <span class="slider round"></span>
                </label>
                <label>Modo Escuro</label>
            </div>
        </form>
    </div>
@endsection