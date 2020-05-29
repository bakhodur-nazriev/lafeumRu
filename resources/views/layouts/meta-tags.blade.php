<title>{{$data['title']}}</title>

@if($data['description'])
    <meta name="description" content="{{$data['description']}}">
@endif

<meta property="og:locale" content="ru_RU">
<meta property="og:type" content="object">
<meta property="og:title" content="{{$data['title']}}">
<meta property="og:url" content="{{$data['url']}}">
<meta property="og:site_name" content="ЛАФЕЮМ">
@if($data['description'])
    <meta property="og:description" content="{{$data['description']}}">
@endif


<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{$data['title']}}">
@if($data['description'])
    <meta name="twitter:description" content="{{$data['description']}}">
@endif
<meta name="twitter:image" content="{{$data['imageUrl']}}">