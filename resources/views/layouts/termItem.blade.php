@php
    if(isset($item) && !isset($term)){
        $term = $item;
    }

    $termСategories = collect($term->categories)->sortBy('name');
@endphp

<div class="card-block summary-links-wrapper">
    <div class="row px-3 mb-2 d-flex">
        <div class="col-6 p-0 atom-icon-block">
            @if($term->termType['name'] == 'Термины научного мира')
                <img src="/img/icons/atom.png"/>
                <img src="/img/icons/atom.png"/>
                <img src="/img/icons/atom.png"/>
            @else
                <span class="font-weight-bold secondary">{{ $term->termType['name'] }}</span>
            @endif
        </div>
        <div class="col-6 p-0 text-right">
            <a class="secondary mr-2 ignore-summary" href="/{{ $term->post->id }}">#{{$term->post->id}}</a>
        </div>
    </div>
    <div class="mb-1">{!! $term->body !!}</div>
    <div class="tags-block">
        @foreach($termСategories as $category)
            <a class="tags-color" href="/terms/{{ $category->slug }}">
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
                data-url="{{env('APP_URL')}}/{{ $term->post->id }}"
                class="ya-share2"
                href="/{{ $term->post->id }}"
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
