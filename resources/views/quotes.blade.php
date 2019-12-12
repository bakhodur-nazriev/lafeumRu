@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3">
                <h3>Темы</h3>
                <a href="">фывафыва</a>
            </div>
            <div class="col-md-9 col-xl-8">
                <h3>Цитаты и Афоризмы</h3>
                <p>Красивые цитаты и афоризмы великих людей, жизненные со смыслом высказывания известнейших поэтов,
                    писателей и философов. Понятия и суждения компетентных ученых и специалистов.
                </p>
                @foreach ($quotes as $quote)
                    <div class="quotes-blocks">
                        <a href="#">
                            <img src="/img/person-60.png" alt="" class="qouter-authors-image">Марк Туллий Цицерон
                        </a>
                        <p>{{ $quote->body }}</p>

                        <a href="#">
                            <img src="/img/tag.png" alt="" class="qouter-authors-image">{{ $quote->tag }}
                        </a>
                        <div class="quotes-divider"></div>
                        <button class="btn qouter-share">Поделиться</button>
                    </div>
                @endforeach
                <div class="row">
                    <div class="col-12">
                        <nav aria-label="Page navigation example">
                            <div class="row d-flex justify-content-center my-6">
                                {!! $quotes->links(); !!}
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
