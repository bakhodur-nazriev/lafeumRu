@extends("layouts.default")

@section("content")
    <div class="row">
        @include('layouts.categories', ['type' => 'App\Term'])
        <div class="col-md-9 col-lg-8 offset-lg-1">
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
                    <h5 class="mt-2 mb-0"><b>Введите термин</b></h5>
                </div>
                <div class="col-md-5 col-xl-4 input-group mb-3">
                    <input
                        type="text"
                        id="vocabulary-search"
                        class="form-control"
                        placeholder="Поиск"
                    >
                </div>
            </div>
            <div class="row">
                <ul class="list-inline py-1 list-of-knowledge">
                    @foreach($vocabularies as $vocabulary)
                        <li class="vocabulary">
                            <a href="/vocabulary/{{$vocabulary->id}}">{{$vocabulary->name}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <script>
                $(document).ready(() => {
                    $("#vocabulary-search").keyup((e) => {
                        search(".list-of-knowledge", e.target.value);
                    })
                })
            </script>
        </div>
    </div>
@endsection
