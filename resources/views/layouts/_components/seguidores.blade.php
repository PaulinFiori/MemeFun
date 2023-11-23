@if(count($seguidores) > 0)
    @foreach ($seguidores as $seguidor)
        <div class="mb-3 card-seguidores col-12 col-sm-4 col-md-3 col-lg-2 shadow-lg" onclick="window.location.href = '{{ route('perfil', [base64_encode($seguidor->seguidor->id)]) }}'">
            @if($seguidor->seguidor->foto != null)
                <img src="{{ config('app.url') . '/' . $seguidor->seguidor->foto }}" class="rounded-circle img-seguidres">
            @else
                <img src="{{ asset('images/default-user.jpg') }}" class="rounded-circle img-seguidres">
            @endif
            <a class="max-content-width margin-nome link-perfil">{{ $seguidor->seguidor->name }}</a>
        </div>
    @endforeach
@endif
