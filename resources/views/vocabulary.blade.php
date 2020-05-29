@extends("layouts.default")

@section('meta-tags')
    @include('layouts.meta-tags', [
        'title' => isset($category) ? $category->name . ' - словарь': 'Словарь',
        'description' => isset($category) ? $category->description: ''
    ])
@endsection

@section('left-side-bar')
    @include('layouts.left-sidebar.categories', [
        'type' => 'App\Term', 
        'linkPrefix' => 'vocabulary',
        'active' => isset($category) ? $category->id : null
    ])
@endsection

@section("content")
    @if (isset($category))
        <h3 class="secondary">{{$category->name}}</h3>
        <p>{{$category->description}}</p>
    @else
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
    @endif
    <div class="row d-flex justify-content-center">
        <div class="col-12 text-center">
            Примеры информативных поисковых запросов: «нау», «логия», «ика», «изм», «фило», «само»,<br>
            «чело»,
            «соц», «пси», «лич», «упр», «жи» , «кул», «эво» и т.п.<br>
            <h5 class="mt-2 mb-0"><b>Введите термин</b></h5>
        </div>
        <div class="col-md-5 col-xl-4 form-group mb-3">
            <input
                type="text"
                id="vocabulary-search"
                class="form-control"
                placeholder="Поиск"
            />
            <small id="vocabulary-search-result" class="form-text text-muted ml-1"></small>
        </div>
    </div>
    <div class="row">
        <ul class="list-inline py-1 list-of-knowledge summary-links-wrapper">
            @foreach($terms as $term)
                <li class="vocabulary">
                    <a href="/{{$term->post->id}}" target="_blank">{{$term->name}}</a>
                </li>
            @endforeach
        </ul>
    </div>
    <script>
        $(document).ready(() => {
            attachSearch(
                "#vocabulary-search", 
                ".list-of-knowledge", 
                '#vocabulary-search-result'
            );
        });
    </script>
@endsection

@section('right-side-bar')@endsection