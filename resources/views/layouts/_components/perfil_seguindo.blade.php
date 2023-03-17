@if(count($usuario->seguindo) > 0)
    <div class="mt-2 mb-5 mx-1">
        <h1>Seguindo</h1>
    </div>

    <div class="row mb-5 d-block d-sm-flex gap-3 mx-1">
        @foreach ($usuario->seguindo as $seguindo)
            <div class="mb-3 card-seguidores col-12 col-sm-4 col-md-3 col-lg-2 shadow-lg" onclick="window.location.href = '{{ route('perfil', [$seguindo->seguindo->id]) }}'">
                @if($seguindo->seguindo->foto != null)
                    <img src="{{ config('app.url') . '/' . $seguindo->seguindo->foto }}" class="rounded-circle img-seguidres">
                @else
                    <img src="{{ asset('images/default-user.jpg') }}" class="rounded-circle img-seguidres">
                @endif
                <a class="max-content-width margin-nome link-perfil">{{ $seguindo->seguindo->name }}</a>
                @auth
                    @if($seguindo->usuario->id == auth()->user()->id)
                        <a class="float-right">
                            <i class="fa-solid fa-user-minus"></i>
                        </a>
                    @endif
                @endauth
            </div>
        @endforeach
    </div>
@else
    <p class="font-weight-bold text-center mb-3 mt-3">Esse usuário não segue ninguém.</p>
@endif