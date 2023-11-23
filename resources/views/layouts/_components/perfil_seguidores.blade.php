@if(count($seguidores) > 0)
    <div class="mt-2 mb-5 mx-1">
        <h1>Seguidores</h1>
    </div>

    <div class="row mb-5 d-block d-sm-flex gap-3 mx-1" id="seguidores-container">
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

        <div class="d-none">
            {{ $seguidores->links() }}
        </div>
    </div>
@else
    <p class="font-weight-bold text-center mb-3 mt-3">Esse usuário não é seguido por ninguém.</p>
@endif

<script>
    $(document).ready(function() {
        let nextPageUrl = '{{ $seguidores->nextPageUrl() }}' + '&tab=seguidores';
        console.log($(window).scrollTop() + $(window).height() >= $(document).height() - 100);
        console.log(nextPageUrl);
        $(window).scroll(function () {
            if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
                if (nextPageUrl) {
                    loadMoreSeguidores();
                }
            }
        });

        function loadMoreSeguidores() {
            $.ajax({
                url: nextPageUrl,
                type: 'get',
                beforeSend: function () {
                    nextPageUrl = '';
                },
                success: function (data) {
                    nextPageUrl = data.nextPageUrl;
                    $('#seguidores-container').append(data.view);
                },
                error: function (xhr, status, error) {
                    console.error("Erro ao carregar mais seguidores:", error);
                }
            });
        }
    });
</script>