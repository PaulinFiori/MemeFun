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