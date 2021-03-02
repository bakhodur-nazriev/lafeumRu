@extends('layouts.default')

@section('meta-tags')
    @include('layouts.meta-tags', [
        'title' => 'Цитаты, афоризмы и высказывания.',
        'description' => 'Красивые цитаты и афоризмы великих людей, жизненные со смыслом высказывания известнейших поэтов, писателей и философов.',
        'next' => $quotes->nextPageUrl(),
        'prev' => $quotes->previousPageUrl()
    ])
@endsection

@section('left-side-bar')
    @include('layouts.left-sidebar.leftSidebar', ['type' => 'App\Quote'])
@endsection

@section('content')
    <h3 class="secondary">Цитаты и Афоризмы</h3>
    <p>
        Лучшие цитаты, афоризмы и высказывания великих ученых и мыслителей, известных и успешных людей на тематику
        сайта.
    </p>
    @foreach ($quotes as $quote)
        @include('layouts.quoteItem')
    @endforeach
    <div class="col-12">
        <nav aria-label="Page navigation example">
            <div class="row d-flex justify-content-center mt-3">
                {!! $quotes->onEachSide(2)->links() !!}
            </div>
        </nav>
    </div>
@endsection
