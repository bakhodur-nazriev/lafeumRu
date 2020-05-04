@extends('layouts.default')

@section('content')
    <div class="row card-main-block">
        @include('layouts.categories', ['type' => 'App\Term'])
        <div class="col-md-9 d-flex justify-content-around">
            <div class="col-md-7 col-lg-7 col-sm-12">
                <h3 class="secondary mb-4">Термины</h3>
                @foreach($terms as $term)
                    <div class="card-block">
                        <div class="row px-3 mb-2 d-flex">
                            <div class="col-6 p-0">
                                <p class="mb-1">
                                    <i class="fa fa-diamond secondary"></i>
                                    <i class="fa fa-diamond secondary"></i>
                                    <i class="fa fa-diamond secondary"></i>
                                </p>
                            </div>
                            <div class="col-6 p-0 text-right">
                                <i data-id="{{$term->id}}"
                                   class="fa fa-star favourite-term-btn {{$term->isFavorited() ? " fa-star-active": ""}}"
                                   data-toggle="tooltip"
                                   data-placement="top"
                                   title="Избранный"
                                ></i>
                            </div>
                        </div>
                        <div class="mb-1">{!! $term->body !!}</div>
                        <div class="tags-block">
                            @foreach($term->categories as $category)
                                <a href="#">
                                    <i class="fa fa-tags"></i>
                                    {{ $category->name }}
                                </a>
                            @endforeach
                        </div>
                        <div class="my-main-divider"></div>
                        <a class="share-button">
                            <div class="share-text">Поделиться</div>
                            <div class="share"></div>
                        </a>
                    </div>
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
