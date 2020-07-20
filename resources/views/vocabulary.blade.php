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
        <p>
            Словарь «ЛАФЕЮМ» на сегодня содержит более одной тысячи основных терминов, соответствующих тематике сайта.
            Для удобства термины дополнительно разбиты на темы. Большинство терминов взяты из Википедии с 
            указанием ссылки на источник. В большинстве понятий имеются другие взаимосвязанные термины и ссылки. 
            По мере обновления на основном источнике здесь они будут равным образом обновляться.
        </p>
    @endif
    <div class="row d-flex justify-content-center">
        <div class="col-12 text-center">
            Примеры информативных поисковых запросов: «нау», «логия», «ика», «изм», «фило», «само», «чело», «соц», «пси», «эво» и т.п.<br>
            <h5 class="mt-2 mb-0"><b>Введите термин</b></h5>
        </div>
        <div class="col-md-5 col-xl-4">
            <form id="vocabulary-search-form">
                <div class="input-group">
                    <input
                        type="string"
                        id="vocabulary-search"
                        class="form-control"
                        placeholder="Поиск"
                    />
                    <div class="input-group-append">
                        <button
                            id="vocabulary-search-reset"
                            type="button"
                            class="input-group-text cursor-pointer"
                            style="display: none;"
                        >
                            <i class="fa fa-times-circle"></i>
                        </button>
                        <button
                            type="submit"
                            class="input-group-text cursor-pointer"
                        >
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
                <small id="vocabulary-search-result" class="form-text text-muted ml-1"></small>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col py-0">
            <div class="accordion" id="ajax-search-results-accordion" style="display: none;">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                                    data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                Результаты по сети
                            </button>
                        </h2>
                    </div>

                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne"
                         data-parent="#ajax-search-results-accordion">
                        <div class="card-body">
                            <ul id="ajax-search-results" class="list-inline py-1" style="column-count: 4;"></ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <ul class="list-inline py-1 list-of-knowledge summary-links-wrapper">
                @foreach($terms as $term)
                    <li class="vocabulary">
                        <a class="vocabulary-color" href="/{{$term->post->id}}" target="_blank">{{$term->name}}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <script>
        $(document).ready(() => {
            $("#vocabulary-search-form").submit((e) => {
                e.preventDefault();

                let filter = document.getElementById("vocabulary-search").value;

                runVocabularySearch(filter);
            });
        });

        function runVocabularySearch(keyword) {
            searchInTerms(keyword);

            let foundCount = search(".list-of-knowledge", keyword);

            attachSummaryModals();

            attachSearchResults(foundCount, '#vocabulary-search-result');

            showResetButton();
        }

        function searchInTerms(keyword) {
            $.get(`/terms/links-search?key=${keyword}`)
                .then(r => applyAjaxSearchResults(r));
        }

        function applyAjaxSearchResults(results) {
            let accordion = document.getElementById("ajax-search-results-accordion");
            let listElement = document.getElementById("ajax-search-results");

            listElement.innerHTML = "";

            if (!Array.isArray(results) || !results.length) {
                accordion.style.display = "none";
                return;
            }

            for (const result of results) {
                let li = document.createElement('li');
                li.className = "vocabulary";

                let anchor = document.createElement('a');
                anchor.href = result.link;
                anchor.innerText = result.text;

                li.appendChild(anchor);

                listElement.appendChild(li);
            }

            accordion.style.display = "block";
        }

        function attachSearchResults(count, element) {
            let elementToShowResult = document.querySelector(element);

            if (!elementToShowResult) return;

            if (foundCount === null) {
                elementToShowResult.textContent = '';

            } else if (foundCount > 0) {
                elementToShowResult.textContent = `Обнаружено ${foundCount} совпадений`;

            } else {
                elementToShowResult.textContent = `По вашему запросу ничего не обнаружено`;
            }
        }

        function showResetButton() {
            let resetButton = document.getElementById("vocabulary-search-reset");

            let searchInput = document.getElementById("vocabulary-search");

            searchInput.style.borderRight = 'none';
            resetButton.style.display = 'block';

            resetButton.onclick = () => {
                searchInput.value = '';
                runVocabularySearch('');
                resetButton.style.display = 'none';
                searchInput.style.removeProperty('border-right');
            };
        }

    </script>
@endsection

@section('right-side-bar')@endsection
