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
            <div class="col-xl-6 col-md-9">
                <h3>Словарь «Лафеюм»</h3>
                <p>Словарь «ЛАФЕЮМ» на сегодня содержит более одной тысячи основных терминов, соответствующих тематики
                    сайта.
                    Для удобства чтения и пользования словарем термины дополнительно разбиты на темы.
                    Большинство терминов взяты из Википедии (около 98%) с указанием прямой ссылки на источник.
                    В большинстве определений имеются другие взаимосвязанные по теме термины,
                    что в совокупности увеличивает общее количество терминов в словаре до более двух тысяч.
                    Также в некоторых есть ссылки на их страницы в категориях Википедии, а часть терминов содержат
                    ссылки на Викисловарь.
                    По мере обновления на основном источнике здесь они будут равным образом обновляться.</p>
                <div class="row d-flex justify-content-center">
                    <div class="col-5">
                    <span class="authors-main-title">
                        <h4>
                            <strong>Ведите термин</strong>
                        </h4>
                    </span>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Поиск по термину"
                                   aria-label="Поиск по авторам" aria-describedby="button-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="button-addon2">
                                    <span>Поиск</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 authors-links">
                        <a href="#">Lorem, ipsum dolor.</a>
                        <a href="#">Lorem, ipsum dolor.</a>
                        <a href="#">Lorem, ipsum dolor.</a>
                        <a href="#">Lorem, ipsum dolor.</a>
                        <a href="#">Lorem, ipsum dolor.</a>
                        <a href="#">Lorem, ipsum dolor.</a>
                    </div>
                    <div class="col-4 authors-links">
                        <a href="#">Lorem, ipsum dolor.</a>
                        <a href="#">Lorem, ipsum dolor.</a>
                        <a href="#">Lorem, ipsum dolor.</a>
                        <a href="#">Lorem, ipsum dolor.</a>
                        <a href="#">Lorem, ipsum dolor.</a>
                        <a href="#">Lorem, ipsum dolor.</a>
                    </div>
                    <div class="col-4 authors-links">
                        <a href="#">Lorem, ipsum dolor.</a>
                        <a href="#">Lorem, ipsum dolor.</a>
                        <a href="#">Lorem, ipsum dolor.</a>
                        <a href="#">Lorem, ipsum dolor.</a>
                        <a href="#">Lorem, ipsum dolor.</a>
                        <a href="#">Lorem, ipsum dolor.</a>
                        <a href="#">Lorem, ipsum dolor.</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
