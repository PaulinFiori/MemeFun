@if(auth()->user() != null) 
    @if(auth()->user()->configuracao != null && auth()->user()->configuracao->modo_escuro == 1)
    <link rel="stylesheet" href="{{ asset('css/modo_escuro.css') }}"/> 
    @endif
@endif

<footer class="bg-light text-center text-lg-start footer">
    <div class="text-center p-3">
        © 2023 Copyright:
        <a class="text-dark" href="{{ config('app.url') }}">Memefun</a>
    </div>
</footer>