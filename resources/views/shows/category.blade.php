@extends('layouts.default')

@section('content')
<div class="row card-main-block">
    @include('layouts.categories', ['type' => $category->type, 'active' => $category->id])
    <div class="col-md-9 col-xl-9 col-sm-12 d-flex justify-content-around flex-wrap">
        <div class="col-md-8 col-lg-8">
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
        </div>
        @include('layouts.rightSidebar')
    </div>
</div>
@endsection