@extends("layouts.default")

@section("content")
    <div class="row d-flex justify-content-center">
        <div class="col-md-4 col-xl-4">
            <span class="authors-main-title">
                <h3 class="secondary">Авторы</h3>
                <p class="ma-3">Авторы. Полный список всех авторов по алфавиту, а также есть возможность поиска.</p>
            </span>
            <div class="form-group mb-3">
                <input
                    type="search"
                    id="author-search"
                    class="form-control"
                    placeholder="Поиск по авторам"
                >
                <small id="authors-search-result" class="form-text text-muted ml-1"></small>
            </div>
        </div>
    </div>
    <div class="row">
        <ul class="list-inline py-1 list-of-authors">
            @foreach ($authors as $author)
                <li class="author">
                    <a href="/authors/{{$author->slug}}">{{ $author->name }}</a>
                </li>
            @endforeach
        </ul>
    </div>
    <script>
        $(document).ready(() => {
            attachSearch(
                "#author-search", 
                ".list-of-authors", 
                '#authors-search-result'
            );
        })
    </script>
@endsection

@section('right-side-bar')@endsection