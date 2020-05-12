@extends('layouts.default')

@section('content')
    <div class="row card-main-block">
        @include('layouts.categories', ['type' => 'App\Term'])
        <div class="col-md-9 d-flex justify-content-around">
            <div class="col-md-7 col-lg-7 col-sm-12">
                <h3 class="secondary mb-4">Термины</h3>
                @foreach($terms as $term)
                    @include('layouts.termItem')
                @endforeach
                <div class="row">
                    <div class="col-12">
                        <nav aria-label="Page navigation example">
                            <div class="row d-flex justify-content-center my-6">
                                {!! $terms->links(); !!}
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
            @include('layouts.rightSidebar')
        </div>
    </div>
    <script>
        function termToggleFavourite(termId, onSuccess = null, onFailure = null) {
            const termModel = "App\\Term";
            $.ajax({
                url: '/toggle-favourite',
                method: 'PUT',
                data: {
                    "_token": window.Laravel.csrf_token,
                    favouritable: termModel,
                    id: termId
                }
            }).then(onSuccess).catch(onFailure);
        }

        $(document).ready(() => {
            $('.favourite-term-btn').click(e => {
                let button = e.target;
                let id = button.dataset.id;

                termToggleFavourite(id, (isFavourite) => {
                    button.classList.toggle('fa-star-active', isFavourite);
                });
            });
        });
    </script>
@endsection
