@if(count($seguindos) > 0)
    @foreach ($seguindos as $seguindo)
        <div class="mb-3 card-seguidores col-12 col-sm-4 col-md-3 col-lg-2 shadow-lg">
            @if($seguindo->seguindo->foto != null)
                <img src="{{ config('app.url') . '/' . $seguindo->seguindo->foto }}" class="rounded-circle img-seguidres" onclick="window.location.href = '{{ route('perfil', [base64_encode($seguindo->seguindo->id)]) }}'">
            @else
                <img src="{{ asset('images/default-user.jpg') }}" class="rounded-circle img-seguidres" onclick="window.location.href = '{{ route('perfil', [base64_encode($seguindo->seguindo->id)]) }}'">
            @endif
            <a class="max-content-width margin-nome link-perfil" onclick="window.location.href = '{{ route('perfil', [base64_encode($seguindo->seguindo->id)]) }}'">{{ $seguindo->seguindo->name }}</a>
            @auth
                @if($seguindo->usuario->id == auth()->user()->id)
                    <a class="float-right" onclick="deseguir({{$seguindo->seguindo->id}})">
                        <i class="fa-solid fa-user-minus"></i>
                    </a>
                @endif
            @endauth
        </div>
    @endforeach
@endif