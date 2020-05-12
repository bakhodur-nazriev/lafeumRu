@extends('layouts.default')

@section('content')
    <div class="row card-main-block">
        @include('layouts.categories', ['type' => 'App\Quote'])
        <div class="col-md-9 col-xl-9 col-sm-12 d-flex justify-content-around flex-wrap">
            <div class="col-md-7 col-lg-7">
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
            @include('layouts.rightSidebar')
        </div>
    </div>

    <script>
        function quoteToggleFavourite(quoteId, onSuccess = null, onFailure = null) {
            const quoteModel = "App\\Quote";
            $.ajax({
                url: '/toggle-favourite',
                method: 'PUT',
                data: {
                    "_token": window.Laravel.csrf_token,
                    favouritable: quoteModel,
                    id: quoteId
                }
            }).then(onSuccess).catch(onFailure);
        }

        $(document).ready(() => {
            $('.favourite-quote-btn').click(e => {
                let button = e.target;
                let id = button.dataset.id;

                quoteToggleFavourite(id, (isFavourite) => {
                    button.classList.toggle('fa-star-active', isFavourite);
                });
            });
        });
    </script>
@endsection
