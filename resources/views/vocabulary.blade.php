@extends("layouts.default")

@section("content")
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-12">
                <h3 class="secondary">Темы</h3>
                @foreach($categories as $category)
                    <div class="categories-main-name">
                        <a href="#"><b>{{ $category->name }}</b></a>
                    </div>
                    @foreach($category->children as $subCategory)
                        <div><a href="#">{{$subCategory->name}}</a></div>
                    @endforeach
                @endforeach
            </div>
            <div class="col-md-9">
                <h3 class="secondary">Словарь «Лафеюм»</h3>
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
                    <div class="col-12 text-center">
                        Примеры информативных поисковых запросов: «нау», «логия», «ика», «изм», «фило», «само»,<br>
                        «чело»,
                        «соц», «пси», «лич», «упр», «жи» , «кул», «эво» и т.п.<br>
                        <b>Введите термин</b>
                    </div>
                    <div class="col-md-5 input-group mb-3">
                        <input
                            type="text"
                            id="vocabulary-search"
                            class="form-control"
                            placeholder="Поиск"
                        >
                    </div>
                </div>
                <div class="row">
                    @foreach($vocabularies as $vocabulary)
                        <div class="col-md-4 py-1 vocabulary">
                            <a href="/vocabulary/{{$vocabulary->slug}}">{{$vocabulary->name}}</a>
                        </div>
                    @endforeach
                </div>
                <script>
                    $(document).ready(() => {
                        $("#vocabulary-search").keyup((e) => {
                            search(".vocabulary", e.target.value);
                        })
                    })
                </script>
            </div>
        </div>
    </div>
@endsection
