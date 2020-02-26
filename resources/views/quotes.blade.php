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
                        <div class="row mb-2">
                            <div class="col py-0">
                                <a href="#">
                                    <img src="/img/person-60.png" alt=""
                                         class="qouter-authors-image">{{ $quote->author->name }}
                                </a>
                            </div>
                            <div class="col py-0 text-right">
                                <i data-id="{{$quote->id}}"
                                   class="fa fa-star favourite-quote-btn {{$quote->isFavorited() ? " fa-star-active": ""}}"
                                   data-toggle="tooltip"
                                   data-placement="top"
                                   title="Избранный"
                                ></i>
                            </div>
                        </div>
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
        function quoteToggleFavourite(quoteId, onSuccess = null, onFailure = null) {
            const quoteModel = "App\\Quote";

            $.ajax({
                url: '/toggle-favourite', method: 'PUT',
                data: {
                    "_token": window.Laravel.csrf_token,
                    favouritable: quoteModel,
                    id: quoteId
                }
            }).then(onSuccess).catch(onFailure);
        }

        $(document).ready(() => {
            $('.favourite-quote-btn').click(e => {
                let button = e.target;
                let id = button.dataset.id;

                quoteToggleFavourite(id, (isFavourite) => {
                    button.classList.toggle('fa-star-active', isFavourite);
                });
            });
        });
    </script>
@endsection
