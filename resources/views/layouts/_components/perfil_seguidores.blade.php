@if(count(auth()->user()->seguidores))
    <div class="mt-2 mb-5 mx-1">
        <h1>Seguidores</h1>
    </div>

    <div class="row mb-5 d-block d-sm-flex gap-3 mx-1">
        <div class="mb-3 card-seguidores col-12 col-sm-4 col-md-3 col-lg-2 shadow-lg">
            <img src="{{ asset('images/default-user.jpg') }}" class="rounded-circle img-seguidres">
            <a class="max-content-width margin-nome link-perfil">Fulano</a>
        </div>

        <div class="mb-3 card-seguidores col-12 col-sm-4 col-md-3 col-lg-2 shadow-lg">
            <img src="{{ asset('images/default-user.jpg') }}" class="rounded-circle img-seguidres">
            <a class="max-content-width margin-nome link-perfil">Fulano</a>
        </div>

        <div class="mb-3 card-seguidores col-12 col-sm-4 col-md-3 col-lg-2 shadow-lg">
            <img src="{{ asset('images/default-user.jpg') }}" class="rounded-circle img-seguidres">
            <a class="max-content-width margin-nome link-perfil">Fulano</a>
        </div>
    </div>
@else
    <p class="font-weight-bold text-center mb-3 mt-3">Esse usuário não é seguido por ninguém.</p>
@endif