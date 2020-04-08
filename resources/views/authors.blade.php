@extends("layouts.default")

@section("content")
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-4 col-xl-4">
                <span class="authors-main-title">
                    <h3 class="secondary">Авторы</h3>
                    <p class="ma-3">Авторы. Полный список всех авторов по алфавиту, а также есть возможность поиска.</p>
                </span>
                <div class="input-group mb-3">
                    <input
                        type="text"
                        id="author-search"
                        class="form-control"
                        placeholder="Поиск по авторам"
                    >
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($authors as $author)
                <div class="col-sm-6 col-md-3 author py-1">
                    <a href="/author/{{$author->id}}">{{ $author->name }}</a>
                </div>
            @endforeach
        </div>
        <script>
            $(document).ready(() => {
                $("#author-search").keyup((e) => {
                    search(".author", e.target.value);
                })
            })
        </script>
    </div>
@endsection

