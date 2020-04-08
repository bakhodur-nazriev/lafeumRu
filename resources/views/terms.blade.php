@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="row card-main-block">
            <div class="col-md-3 col-sm-12">
                <h3 class="secondary">Темы</h3>
                @foreach($categories as $category)
                    <div class="categories-main-name">
                        <a href="#"><b>{{ $category->name }}</b></a>
                    </div>
                    @foreach($category->children as $subCategory)
                        <div><a href="#">{{$subCategory->name}}</a></div>
                    @endforeach
                @endforeach
            </div>
            <div class="col-md-9 col-sm-12">
                <h3 class="secondary mb-4">Термины</h3>
                @foreach($terms as $term)
                    <div class="card-block">
                        <div class="row">
                            <div class="col py-0 text-right">
                                {{--<i data-id="{{$term->id}}"
                                   class="fa fa-star favourite-quote-btn {{$term->isFavorited() ? " fa-star-active": ""}}"
                                   data-toggle="tooltip"
                                   data-placement="top"
                                   title="Избранный"
                                ></i>--}}
                            </div>
                        </div>
                        <p class="mb-1">
                            <i class="fa fa-diamond secondary"></i>
                            <i class="fa fa-diamond secondary"></i>
                            <i class="fa fa-diamond secondary"></i>
                        </p>
                        <p>{!! $term->body !!}</p>
                        <div class="tags-block">
                            @foreach($term->categories as $category)
                                <a href="#">
                                    <i class="fa fa-tags"></i>
                                    {{ $category->name }}
                                </a>
                            @endforeach
                        </div>
                        <div class="my-main-divider"></div>
                        <button class="btn share-button">Поделиться</button>
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
