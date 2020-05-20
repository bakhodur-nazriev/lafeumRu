@extends('layouts.frontApp')

@section('layout')
    @include('layouts.navbar')
    
    <div class="container-fluid">
        <div class="row">
            <div class="left-sidebar-col">@yield('left-side-bar')</div>

            <div class="col">
                @yield('content')
            </div>
            
            <div class="right-sidebar-col">@yield('right-side-bar', View::make('layouts.right-sidebar.rightSidebar'))</div>

            <button class="btn btn-primary btnScrollToTop">
                <i class="fa fa-arrow-up"></i>
            </button>
        </div>
    </div>

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
