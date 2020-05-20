@extends("layouts.default")

@section("content")
    <div class="row d-flex justify-content-center">
        <div class="col-md-4 col-xl-4">
            <span class="authors-main-title">
                <h3 class="secondary">Авторы</h3>
                <p class="ma-3">Авторы. Полный список всех авторов по алфавиту, а также есть возможность поиска.</p>
            </span>
            <div class="input-group mb-3">
                <input
                    type="search"
                    id="author-search"
                    class="form-control"
                    placeholder="Поиск по авторам"
                >
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
            $("#author-search").keyup((e) => {
                search(".list-of-authors", e.target.value);
            });
        })
    </script>
@endsection

@section('right-side-bar')@endsection