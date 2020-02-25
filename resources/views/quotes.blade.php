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
                {{-- <div>
                    <button>
                        <i class="fa fa-thumbs-up"></i>
                    </button>
                    <button>
                        <i class="fa fa-thumbs-down"></i>
                    </button>
                </div> --}}
                <div>
                    <button type="button" onclick="quoteToggleFavourite({{$quote->id}})"
                        class="btn qouter-share  {{$quote->isFavorited() ? " favourite-active": ""}}"
                        data-isfavourite={{$quote->isFavorited() ? "1": "0"}} data-tooltip data-placement="top"
                        title="Избранный">
                        <i class="fa fa-star"></i>
                    </button>
                    <button class="btn qouter-share">Поделиться</button>
                </div>
                <div id="getRequestData"></div>
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

<script>
    function quoteToggleFavourite(quoteId){
        const quoteModel = "App\\Quote";
        $.ajax({ url: '/api/toggle-favourite', method: 'PUT', data:{
            favouritable: quoteModel,
            id: quoteId
        }}).then((res) => {
            console.log(res);
        });
    }
</script>
@endsection