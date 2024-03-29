<title>{{$data['title']}}</title>

@if (App::environment('production'))
    @includeIf('layouts.seoMetrics')
@else
    <meta name="robots" content="none"/>
    <meta name="googlebot" content="noindex, nofollow"/>
    <meta name="yandex" content="none"/>
@endif

@if($data['description'])
    <meta name="description" content="{{$data['description']}}">
    <meta property="og:description" content="{{$data['description']}}">

    <meta name="twitter:description" content="{{$data['description']}}">
@endif

<meta property="og:locale" content="ru_RU">
<meta property="og:type" content="object">
<meta property="og:title" content="{{$data['title']}}">
<meta property="og:url" content="{{$data['url']}}">
<meta property="og:site_name" content="ЛАФЕЮМ">
<meta property="og:image" content="{{$data['imageUrl']}}">

@if ($data['article'])
    <meta property="article:section" content="{{$data['article']['section']}}">
    <meta property="article:published_time" content="{{$data['article']['published']}}">
    <meta property="article:modified_time" content="{{$data['article']['updated']}}">
    <meta property="og:updated_time" content="{{$data['article']['updated']}}">
@endif

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{$data['title']}}">
<meta name="twitter:image" content="{{$data['imageUrl']}}">

<script type="application/ld+json">{!! json_encode($data['schema'], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); !!}</script>

<link rel="canonical" href="{{$data['canonical']}}">
