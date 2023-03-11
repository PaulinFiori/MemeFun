@extends('layouts.basicLayout')

@section('titulo', 'MemeFun - Ranking')

@section('conteudo')
    <link rel="stylesheet" href="{{ asset('css/ranking.css') }}"/>

    <div class="container-fluid mt-3">
        <div class="row">
            <div class="row cards d-block d-sm-flex justify-content-center">
                <div class="col-12 col-sm-5 col-md-3 col-lg-3 card text-center mx-3 mb-3">
                    <div class="card-title">
                        @if(1 >= 10)
                            <h2 class="posicao10">11</h2>
                        @else
                            <h2 class="posicao">1</h2>
                        @endif
                    </div>

                    <div class="card-body">
                        <img src="{{ asset('images/default-user.jpg') }}" class="rounded-circle" width="100px" heigth="100px">
                        <p>Fulano</p>
                    </div>

                    <div class="card-footer">
                        <p>5.000 pontos<p>
                    </div>
                </div>

                <div class="col-12 col-sm-5 col-md-3 col-lg-3 card text-center me-3 mb-3">
                    <div class="card-title">
                        @if(1 >= 10)
                            <h2 class="posicao10">12</h2>
                        @else
                            <h2 class="posicao">2</h2>
                        @endif
                    </div>

                    <div class="card-body">
                        <img src="{{ asset('images/default-user.jpg') }}" class="rounded-circle" width="100px" heigth="100px">
                        <p>Beltrano</p>
                    </div>

                    <div class="card-footer">
                        <p>4.000 pontos<p>
                    </div>
                </div>

                <div class="col-12 col-sm-5 col-md-3 col-lg-3 card text-center me-3 mb-3">
                    <div class="card-title">
                        @if(1 >= 10)
                            <h2 class="posicao10">13</h2>
                        @else
                            <h2 class="posicao">3</h2>
                        @endif
                    </div>

                    <div class="card-body">
                        <img src="{{ asset('images/default-user.jpg') }}" class="rounded-circle" width="100px" heigth="100px">
                        <p>Ciclano</p>
                    </div>

                    <div class="card-footer">
                        <p>3.000 pontos<p>
                    </div>
                </div>

                <div class="col-12 col-sm-5 col-md-3 col-lg-3 card text-center me-3 mb-3">
                    <div class="card-title">
                        @if(1 >= 10)
                            <h2 class="posicao10">14</h2>
                        @else
                            <h2 class="posicao">4</h2>
                        @endif
                    </div>

                    <div class="card-body">
                        <img src="{{ asset('images/default-user.jpg') }}" class="rounded-circle" width="100px" heigth="100px">
                        <p>Dediano</p>
                    </div>

                    <div class="card-footer">
                        <p>2.000 pontos<p>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
@endsection