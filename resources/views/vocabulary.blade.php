@extends("layouts.default")

@section("content")
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
            <div class="col-md-9">
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
                    <div class="col-md-5 input-group mb-3">
                        <input
                            type="text"
                            id="author-search"
                            class="form-control"
                            placeholder="Поиск по авторам"
                        >
                    </div>
                </div>
                <div class="row">
                    @foreach($vocabularies as $vocabulary)
                        <div class="col-md-4 py-1">
                            <a href="/terms/{{$vocabulary->id}}">
                                {{$vocabulary->name}}
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
