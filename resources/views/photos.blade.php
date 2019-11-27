@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-5 col-xl-4">
                <span class="authors-main-title">
                    <h3>Фотографии</h3>
                    <p>В данном разделе подборка фотографий на тему жизни и ее красоты.</p>
                </span>
            </div>
        </div>
        <div class="row">
            @foreach ($photos as $photo)
                <div class="col-sm-6 col-md-4 col-xl-3">
                    <a href="#">
                        <div class="card  hoverable border-0 shadow-sm" style="ovewflow: visible;">
                            <div class="card-img-wrapper animated">
                                <img src="{{$photo->image}}" class="rounded card-img-top shadow-sm" style=" " alt="...">
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="row d-flex justify-content-center my-6">
            <nav aria-label="Page navigation example">
                <ul class="pagination photos-pagination">
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
@endsection
