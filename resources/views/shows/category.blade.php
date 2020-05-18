@extends('layouts.default')

@section('content')
    @include('layouts.left-sidebar.categories', ['type' => $category->type, 'active' => $category->id])
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="secondary">{{$category->name}}</h3>
                <p>{{$category->description}}</p>

                @switch($category->type)
                    @case('App\\Quote')

                    @foreach ($category->categoriables as $quote)
                        @include('layouts.quoteItem')
                    @endforeach

                    @break
                    @case('App\\Term')

                    @foreach ($category->categoriables as $term)
                        @include('layouts.termItem')
                    @endforeach

                    @break
                    @case('App\\Video')

                    @foreach ($category->categoriables as $video)
                        @include('layouts.videoItem')
                    @endforeach

                    @break
                @endswitch
                <div class="row">
                    <div class="col-12">
                        <nav aria-label="Page navigation example">
                            <div class="row d-flex justify-content-center mt-3">
                                {{ $category->categoriables->links() }}
                            </div>
                        </nav>
                    </div>
                </div>
                <button class="btn btn-primary btnScrollToTop">
                    <i class="fa fa-arrow-up"></i>
                </button>
            </div>
        </div>
    </div>
    @include('layouts.right-sidebar.rightSidebar')
@endsection
