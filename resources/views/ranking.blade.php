@extends('layouts.basicLayout')

@section('titulo', 'MemeFun - Ranking')

@section('conteudo')
    <link rel="stylesheet" href="{{ asset('css/ranking.css') }}"/>

    <div class="container-fluid mt-3">
        <div class="row">
            <div class="row cards d-block d-sm-flex justify-content-center" id="ranking-container">
                @foreach($ranking as $rank)
                    <div class="col-12 col-sm-5 col-md-3 col-lg-3 card text-center mx-3 mb-3 gray-card">
                        <div class="card-title">
                            @if($rank->posicao >= 10)
                                <h2 class="posicao10">{{ $rank->posicao }}</h2>
                            @else
                                <h2 class="posicao">{{ $rank->posicao }}</h2>
                            @endif
                        </div>

                        <div class="card-body">
                            @if($rank->foto != null)
                                <img src="{{ config('app.url'). '/' . $rank->foto }}" class="rounded-circle" width="100px" heigth="100px">
                            @else
                                <img src="{{ asset('images/default-user.jpg') }}" class="rounded-circle" width="100px" heigth="100px">
                            @endif
                            <p>{{ $rank->name }}</p>
                        </div>

                        <div class="card-footer">
                            <p>{{ $rank->pontos }} pontos<p>
                        </div>
                    </div>
                @endforeach

                <div class="d-none">
                    {{ $ranking->links() }}
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
                let nextPageUrl = '{{ $ranking->nextPageUrl() }}';
                $(window).scroll(function () {
                    if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
                        if (nextPageUrl) {
                            loadMoreRanking();
                        }
                    }
                });

                function loadMoreRanking() {
                    $.ajax({
                        url: nextPageUrl,
                        type: 'get',
                        beforeSend: function () {
                            nextPageUrl = '';
                        },
                        success: function (data) {
                            nextPageUrl = data.nextPageUrl;
                            $('#ranking-container').append(data.view);
                        },
                        error: function (xhr, status, error) {
                            console.error("Erro ao carregar mais ranking:", error);
                        }
                    });
                }
            });
    </script>
@endsection