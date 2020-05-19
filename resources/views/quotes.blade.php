@extends('layouts.default')

@section('content')
    @include('layouts.left-sidebar.categories', ['type' => 'App\Quote'])
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="secondary">Цитаты и Афоризмы</h3>
                <p>Красивые цитаты и афоризмы великих людей, жизненные со смыслом высказывания известнейших поэтов,
                    писателей и философов. Понятия и суждения компетентных ученых и специалистов.
                </p>
                @foreach ($quotes as $quote)
                    @include('layouts.quoteItem')
                @endforeach
                <div class="col-12">
                    <nav aria-label="Page navigation example">
                        <div class="row d-flex justify-content-center mt-3">
                            {{ $quotes->links() }}
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.right-sidebar.rightSidebar')
@endsection
