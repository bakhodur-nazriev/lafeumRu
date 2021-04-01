@php
    if(isset($item) && !isset($qoute)){
        $quote = $item;
    }

    $quoteСategories = collect($quote->categories)->sortBy('name');
@endphp

<div class="card-block">
    <div class="row mb-2">
        <div class="col-6 py-0">
            <a href="/authors/{{$quote->author->slug}}" class="secondary">
                <i class="fa fa-user" style="margin-right: 5px;"></i>{{$quote->author->name}}
            </a>
        </div>
        <div class="col-6 py-0 text-right">
            <a class="secondary mr-2" href="/{{ $quote->post->id }}">#{{ $quote->post->id }}</a>
        </div>
    </div>
    <div class="text-secondary" style="font-size: 12px;">
        <p>{!! $quote->authors_thoughts !!}</p>
    </div>
    <div class="mb-1">{!! $quote->body !!}</div>
    <div class="tags-block">
        @foreach($quoteСategories as $category)
            <a class="tags-color" href="/quotes/{{ $category->slug }}">
                <i class="fa fa-tags"></i>
                {{ $category->name }}
            </a>
        @endforeach
    </div>
    <div class="my-main-divider"></div>

    <div class="dropdown share-button-dropdown-block">
        <button class="share-button">Поделиться</button>
        <div class="dropdown-content-share-button">
            <a
                data-url="{{env('APP_URL')}}/{{ $quote->post->id }}"
                class="ya-share2"
                href="/{{ $quote->post->id }}"
                data-copy="hidden"
                data-description=""
                data-direction="horizontal"
                data-services="vkontakte,facebook,odnoklassniki,twitter,viber,whatsapp,telegram"
                data-title=""
            >
            </a>
        </div>
    </div>
</div>
