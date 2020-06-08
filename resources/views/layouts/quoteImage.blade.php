<!doctype html>
<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>

    <link rel="stylesheet" href="{{public_path("/css/app.css")}}">
    <link rel="stylesheet" href="{{public_path("/css/style.css")}}">

    <style>
        .image {
            display: flex;
            align-items: center;
            font-size: 1.5rem;
            height: 100vh;
        }
        .image .share-button {
            font-size: 1.3rem;
        }
        .favourite-quote-btn {
            font-size: 26px;
        }
        .image .card-block{
            margin-bottom: 0;
        }
    </style>

</head>
<body>
    {{-- Adapt to 1200 x 628 --}}
    <div class="image p-3">
        @include('layouts.quoteItem')
    </div>
</body>

</html>


