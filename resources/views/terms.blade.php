@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3">
                <h3>Темы</h3>
                <a href="#">фывафыва</a>
            </div>
            <div class="col-md-9 col-xl-6">
                <h3 class="mb-4">Термины</h3>
                @foreach($terms as $term)
                    <div class="quotes-blocks">
                        <p>
                                                        <a href="#">Факторы производства</a> — экономические ресурсы, необходимые для производства
                                                        товаров и услуг.
                                                        Традиционно выделяют следующие факторы производства: земля (земельные ресурсы и природные
                                                        ресурсы);
                                                        труд (трудовые ресурсы); капитал (финансовые ресурсы). Также в настоящее время к ним
                                                        традиционно
                                                        добавляют:
                                                        предпринимательская способность (предпринимательство); информация (информационные ресурсы).
                                                        <a href="#">Категория в Википедии.</a>
                            {{ $term->body }}
                        </p>

                        <div class="tags-block">
                            @foreach($term->tags as $tag)
                                <a href="#">
                                    <img src="/img/tag.png" alt="" class="qouter-authors-image">{{ $tag->name }}
                                </a>
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
        <div class="col-md-12 back-to-top">
            <button onclick="topFunction()" class="btn btn-primary" id="arrowTop">
                <img src="/img/top-arrow48.png" alt="back to top">
            </button>
        </div>
    </div>
@endsection
