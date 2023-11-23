@if(count($seguindos) > 0)
    <div class="mt-2 mb-5 mx-1">
        <h1>Seguindo</h1>
    </div>

    <div class="row mb-5 d-block d-sm-flex gap-3 mx-1" id="seguindo-container">
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

        <div class="d-none">
            {{ $seguindos->links() }}
        </div>
    </div>
@else
    <p class="font-weight-bold text-center mb-3 mt-3">Esse usuário não segue ninguém.</p>
@endif

<script>
    $(document).ready(function() {
        let nextPageUrl = '{{ $seguindos->nextPageUrl() }}' + '&tab=seguindo';
        console.log($(window).scrollTop() + $(window).height() >= $(document).height() - 100);
        console.log(nextPageUrl);
        $(window).scroll(function () {
            if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
                if (nextPageUrl) {
                    loadMoreSeguindo();
                }
            }
        });

        function loadMoreSeguindo() {
            $.ajax({
                url: nextPageUrl,
                type: 'get',
                beforeSend: function () {
                    nextPageUrl = '';
                },
                success: function (data) {
                    nextPageUrl = data.nextPageUrl;
                    $('#seguindo-container').append(data.view);
                },
                error: function (xhr, status, error) {
                    console.error("Erro ao carregar mais seguindo:", error);
                }
            });
        }
    });
</script>