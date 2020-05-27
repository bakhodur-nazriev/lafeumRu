@extends("layouts.default")

@section('left-side-bar')
<div>
    <h3 class="secondary">Каналы YouTube</h3>
    <div class="mb-3 form-group">
        <label for="channels-search">Введите название канала</label>
        <input
            type="string" 
            id="channels-search"
            class="form-control"
        >
        <small id="channels-search-result" class="form-text text-muted ml-1"></small>
    </div>
    <div class="channels">
        @foreach($channels as $channelItem)
            <div>
                <a href="/channels/{{$channelItem->slug}}">
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
    <p>{{ $channel->description }}</p>
    <div class="row">
        @foreach($channel->videos as $video)
            @include('layouts.videoItem')
        @endforeach
    </div>
@endsection