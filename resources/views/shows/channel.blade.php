@extends("layouts.default")

@section("content")
    <div class="left-sidebar-block">
        <h3 class="secondary">Каналы YouTube</h3>
        <div class="mb-3">
            <p class="p-1 mb-0">Введите название канала</p>
            <input
                type="text"
                class="form-control"
                placeholder=""
                aria-label=""
                aria-describedby="button-addon1"
            >
        </div>
        @foreach($channels as $channelItem)
            <a href="/channels/{{$channelItem->slug}}">
                {{ $channelItem->name }}
            </a><br>
        @endforeach
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div>
                    <h3 class="secondary">{{ $channel->name }}</h3>
                    <span>{{ $channel->description }}</span>
                </div>
                <div class="row">
                    @foreach($channel->videos as $video)
                        @include('layouts.videoItem')
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @include('layouts.right-sidebar.rightSidebar')
@endsection
