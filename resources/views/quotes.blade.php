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
        <div class="col-md-9 col-xl-8 col-sm-12">
            <h3>Цитаты и Афоризмы</h3>
            <p>Красивые цитаты и афоризмы великих людей, жизненные со смыслом высказывания известнейших поэтов,
                писателей и философов. Понятия и суждения компетентных ученых и специалистов.
            </p>
            @foreach ($quotes as $quote)
            <div class="quotes-blocks">
                <a href="#">
                    <img src="/img/person-60.png" alt="" class="qouter-authors-image">{{ $quote->author->name }}
                </a>
                <div>{!! $quote->body !!}</div>
                <div class="tags-block">
                    @foreach($quote->tags as $tag)
                    <a href="#">
                        <img src="/img/tag.png" alt="" class="qouter-authors-image">{{ $tag->name }}
                    </a>
                    @endforeach
                </div>
                <div class="my-main-divider"></div>
                <div>
                    <a href="#" class="like">
                        <i class="fa fa-thumbs-up" style="color: #909090;">
                            {{$quote->thumb_up}}
                        </i>
                    </a>
                    <a href="#" class="like">
                        <i class="fa fa-thumbs-down" style="color: #909090;">
                            {{$quote->thumb_down}}
                        </i>
                    </a>
                </div>
                @if (Auth::check())
                <div class="panel-footer">
                    <favorite :quote={{ $quote->id }}></favorite>
                </div>
                @endif
                <button class="btn qouter-share">Поделиться</button>
            </div>
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
    </div>
</div>
@endsection