@extends('layouts.default')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3">
            <h3>Темы</h3>
            <div>
                @foreach($categories as $category)
                <a href="">{{ $category->name }}<br></a>
                @endforeach
            </div>
        </div>
        <div class="col-9">
            <h3 class="mb-4">Термины</h3>
            @foreach($terms as $term)
            <div class="quotes-blocks">
                <p>{!! $term->body !!}</p>
                <div class="tags-block">
                    @foreach($term->tags as $tag)
                    <a href="#"><img src="/img/tag.png" alt="" class="qouter-authors-image">{{ $tag->name }}</a>
                    @endforeach
                </div>

                <div class="my-main-divider"></div>
                <button class="btn qouter-share">Поделиться</button>
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
@endsection