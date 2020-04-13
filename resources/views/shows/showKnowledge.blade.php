@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="row card-main-block">
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
            <div class="col-md-9 col-xl-9">
                <h3 class="secondary mb-4">{{ $knowledge->name }}</h3>
                <p>{{ $knowledge->name }} - здесь собраны термины, определения и комментарии в данной области
                    знаний.</p>
                @foreach($terms as $knowledgeArea)
                    <div class="card-block">
                        <div class="row px-3">
                            <div class="py-0">
                                <p>
                                    <i class="fa fa-diamond secondary"></i>
                                    <i class="fa fa-diamond secondary"></i>
                                    <i class="fa fa-diamond secondary"></i>
                                </p>
                                <p>
                                    {{ $knowledgeArea->description }}
                                </p>
                            </div>
                            <div class="col py-0 text-right">
                            </div>
                        </div>

                        <div class="tags-block">
                            @foreach($knowledgeArea->categories as $category)
                                <a href="#">
                                    <i class="fa fa-tags"></i>
                                    {{ $category->name }}
                                </a>
                            @endforeach
                        </div>
                        <div class="my-main-divider"></div>
                        <button class="btn share-button">Поделиться</button>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <nav aria-label="Page navigation example">
                    <div class="row d-flex justify-content-center my-6">
                        {{-- {!! $terms->links(); !!} --}}
                    </div>
                </nav>
            </div>
        </div>
    </div>
@endsection
