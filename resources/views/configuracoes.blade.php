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
                <label class="toggle" for="escuro">
                    <input type="checkbox" class="toggle__input" id="escuro" />
                    <span class="toggle-track">
                        <span class="toggle-indicator">
                            <!-- 	This check mark is optional	 -->
                            <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                    <path d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z"></path>
                                </svg>
                            </span>
                        </span>
                    </span>
                    Modo escuro
                </label>
            </div>

            <button type="submit" class="btn btn-success">
                Salvar
            </button>
        </form>
    </div>
@endsection