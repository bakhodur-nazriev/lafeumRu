@extends("layouts.default")

@section('meta-tags')
    @include('layouts.meta-tags', [
        'title' => 'Авторы всех цитат и высказывания представленых на сайте.',
        'description' => 'Авторы. Полный список всех авторов по алфавиту, а также есть возможность поиска.'
    ])
@endsection

@section("content")
    <authors></authors>

    {{-- <div class="row">
        <div class="col-lg-12">
            <div class="authors-main-title">
                <h3 class="secondary">Авторы</h3>
                <p class="ma-3">Авторы. Полный список всех авторов по алфавиту, а также есть возможность поиска.</p>
            </div>
            <div class="d-flex justify-content-center mt-0">
                <div class="col-md-4 px-0">
                    <div class="input-group">
                        <input
                            type="search"
                            id="author-search"
                            class="form-control"
                            placeholder="Введите имя автора"
                        >
                        <div class="input-group-append">
                            <div class="input-group-text cursor-pointer" id="vocabulary-search-button">
                                <i class="fa fa-search"></i>
                            </div>
                        </div>
                    </div>
                    <small id="authors-search-result" class="form-text text-muted ml-1"></small>
                </div>
            </div>
            <div class="row">
                <ul class="list-inline py-1 list-col-4">
                    @foreach ($authors as $author)
                        <li>
                            <a href="/authors/{{$author->slug}}">{{ $author->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <script>
                $(document).ready(() => {
                    attachSearch(
                        "#author-search",
                        ".list-col-4",
                        '#authors-search-result'
                    );
                })
            </script>
        </div>
    </div> --}}
@endsection

