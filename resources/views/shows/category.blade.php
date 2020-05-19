@extends('layouts.default')

@section('content')
    @include('layouts.left-sidebar.categories', ['type' => $category->type, 'active' => $category->id])
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="secondary">{{$category->name}}</h3>
                <p>{{$category->description}}</p>

                @foreach ($category->categoriables as $item)
                    @switch($category->type)
                        @case('App\\Quote')
                        @include('layouts.quoteItem')
                        @break
                        @case('App\\Term')
                        @include('layouts.termItem')
                        @break
                        @case('App\\Video')
                        <div class="row">
                            @include('layouts.videoItem')
                        </div>
                        @break
                    @endswitch
                @endforeach

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
        </div>
    </div>
    @include('layouts.right-sidebar.rightSidebar')
@endsection
