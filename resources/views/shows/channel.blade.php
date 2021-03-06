@extends("layouts.default")

@section('meta-tags')
    @include('layouts.meta-tags', [
        'title' => $channel->name . ". Цитаты, афоризмы и высказывания.",
        'description' => $channel->description
    ])
@endsection

@section('left-side-bar')
    <div>
        <h3 class="secondary">Каналы YouTube</h3>
        <div class="my-2 form-group">
            <input
                type="string"
                id="channels-search"
                class="form-control"
                placeholder="Введите название канала"
            >
            <small id="channels-search-result" class="form-text text-muted ml-1"></small>
        </div>
        <div class="channels">
            @foreach($channels as $channelItem)
                <div>
                    <a href="/channels/{{$channelItem->slug}}" class="{{Request::is('channels/'.$channelItem->slug) ? 'active': ''}}">
                        {{ $channelItem->name }}
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        $(document).ready(() => {
            attachSearch(
                "#channels-search",
                ".channels",
                '#channels-search-result'
            );
        })
    </script>

@endsection

@section("content")
    <h3 class="secondary">{{ $channel->name }}</h3>
    <p>{!! $channel->description !!}</p>
    <div class="row">
        @foreach($channel->videos as $video)
            @include('layouts.videoItem')
        @endforeach
    </div>
    <!-- <div class="col-12">
        <nav aria-label="Page navigation example">
            <div class="row d-flex justify-content-center mt-3">
                {!! $channel->videos->onEachSide(2)->links() !!}
            </div>
        </nav>
    </div> -->
@endsection
