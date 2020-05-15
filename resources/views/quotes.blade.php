@extends('layouts.default')

@section('content')
    <div class="row card-main-block">
        @include('layouts.categories', ['type' => 'App\Quote'])
        <div class="col-md-9 col-xl-10 col-sm-12 d-flex justify-content-around">
            <div class="col-md-7 col-lg-7 ml-5">
                <h3 class="secondary">Цитаты и Афоризмы</h3>
                <p>Красивые цитаты и афоризмы великих людей, жизненные со смыслом высказывания известнейших поэтов,
                    писателей и философов. Понятия и суждения компетентных ученых и специалистов.
                </p>
                @foreach ($quotes as $quote)
                    @include('layouts.quoteItem')
                @endforeach
                <div class="row">
                    <div class="col-12">
                        <nav aria-label="Page navigation example">
                            <div class="row d-flex justify-content-center mt-3">
                                {{ $quotes->links() }}
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-3 d-flex flex-column">
                @include('layouts.rightSidebarUserBlock')
                @include('layouts.postsSidebarPostsBlock')
            </div>
        </div>
    </div>
@endsection
