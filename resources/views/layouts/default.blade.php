@extends('layouts.frontApp')

@section('layout')
    @include('layouts.navbar')
    <div class="d-flex justify-content-around" style="flex: 1">
        @yield('content')
        <button class="btn btn-primary btnScrollToTop">
            <i class="fa fa-arrow-up"></i>
        </button>
    </div>
    <div class="d-block text-center"><div class="row my-4">
            <div class="col text-center text-uppercase">
                <div class="px-4 py-3" style="background-color: #04718c; color: white">посетителей</div>
                <div class="px-4 py-3" style="background-color: #e0e0e0; font-size: 24px; font-weight: bold;">150
                </div>
            </div>
            <div class="col text-center text-uppercase">
                <div class="px-4 py-3" style="background-color: #04718c; color: white">стран</div>
                <div class="px-4 py-3" style="background-color: #e0e0e0; font-size: 24px; font-weight: bold;">50
                </div>
            </div>
            <div class="col text-center text-uppercase">
                <div class="px-4 py-3" style="background-color: #04718c; color: white">цитат</div>
                <div class="px-4 py-3"
                     style="background-color: #e0e0e0; font-size: 24px; font-weight: bold;">{{$countOfFavoritesQuotes}}</div>
            </div>
            <div class="col text-center text-uppercase">
                <div class="px-4 py-3" style="background-color: #04718c; color: white">авторов</div>
                <div class="px-4 py-3"
                     style="background-color: #e0e0e0; font-size: 24px; font-weight: bold;">{{$countOfAuthors}}
                </div>
            </div>
            <div class="col text-center text-uppercase">
                <div class="px-4 py-3" style="background-color: #04718c; color: white">терминов</div>
                <div class="px-4 py-3"
                     style="background-color: #e0e0e0; font-size: 24px; font-weight: bold;">{{$countOfFavoritesTerms}}
                </div>
            </div>
            <div class="col text-center text-uppercase">
                <div class="px-4 py-3" style="background-color: #04718c; color: white">медиаконтент</div>
                <div class="px-4 py-3"
                     style="background-color: #e0e0e0; font-size: 24px; font-weight: bold;">{{ $countOfMediaContent }}
                </div>
            </div>
        </div></div>
    @include('layouts.footer')
    <script>
        function toggleFavourite(id, model, onSuccess = null, onFailure = null) {
            $.ajax({
                url: '/toggle-favourite',
                method: 'PUT',
                data: {
                    "_token": window.Laravel.csrf_token,
                    favouritable: model,
                    id: id
                }
            }).then(onSuccess).catch(onFailure);
        }

        $(document).ready(() => {
            $('.favourite-quote-btn').click(e => {
                let button = e.target;
                let id = button.dataset.id;

                toggleFavourite(id, "App\\Quote", (isFavourite) => {
                    button.classList.toggle('fa-star-active', isFavourite);
                });
            });

            $('.favourite-term-btn').click(e => {
                let button = e.target;
                let id = button.dataset.id;

                toggleFavourite(id, "App\\Term", (isFavourite) => {
                    button.classList.toggle('fa-star-active', isFavourite);
                });
            });

            $('.favourite-video-btn').click(e => {
                let button = e.target;
                let id = button.dataset.id;

                toggleFavourite(id, "App\\Video", (isFavourite) => {
                    button.classList.toggle('fa-star-active', isFavourite);
                });
            });
        });
    </script>
@endsection
