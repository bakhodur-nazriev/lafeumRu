@extends("layouts.default")

@section("content")
    <div class="row card-main-block">
        <div class="col-md-12 col-lg-2 col-sm-12 p-0 shows-left-block">
            <div class="left-sidebar-block">
                <h3 class="secondary">Каналы YouTube</h3>
                <div class="mb-3">
                    <p class="p-1 mb-0">Введите название канала</p>
                    <input type="text" class="form-control" placeholder="" aria-label="Example text with button addon"
                           aria-describedby="button-addon1">
                </div>
                @foreach($channels as $channelItem)
                    <a href="/channels/{{$channelItem->slug}}">
                        {{ $channelItem->name }}
                    </a><br>
                @endforeach
            </div>
        </div>
        <div class="col-md-12 col-lg-9 d-flex shows-content-and-right-block">
            <div class="col-md-12 col-lg-7">
                <h3 class="secondary">{{ $channel->name }}</h3>
                <p>{{ $channel->description }}</p>
                <div class="row">
                    @foreach($channel->videos as $video)
                        @include('layouts.videoItem')
                    @endforeach
                </div>
            </div>
            <div class="col-md-12 col-lg-4 offset-lg-1 d-flex flex-column">
                @include('layouts.rightSidebarUserBlock')
                @include('layouts.postsSidebarPostsBlock')
            </div>
        </div>
    </div>
@endsection
