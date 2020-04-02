@extends("layouts.default")

@section("content")
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-4 col-xl-4">
                <span class="authors-main-title">
                    <h3>Авторы</h3>
                    <p class="ma-3">Авторы цитат, афоризмов и высказываний, <br>представленных на сайте.</p>
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
                    <a href="#">{{ $author->name }}</a>
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

    {{--<style>
        .card-main-block {
            margin: 15px 0 3px 0;
        }
    </style>--}}
@endsection

