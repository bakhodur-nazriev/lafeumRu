<nav class="navbar navbar-expand-lg navbar-light main-navbar fixed-top">
    <!-- Right Side Of Navbar -->
    @include('layouts.smallNavBar')
    <div class="navbar-login-block">
        <ul class="navbar-nav ml-auto">
            @guest
                <a class="text-light navbar-login-button px-2 text-decoration-none" href="{{ route('login') }}">
                    Вход
                </a>
                @if (Route::has('register'))
                    <a class="text-light navbar-login-button px-2 text-decoration-none" href="{{ route('register') }}">
                        Регистрация
                    </a>
                @endif
            @else
                <li class="nav-item dropdown align-self-center">
                    <a
                        href="#"
                        role="button"
                        id="navbarDropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                        data-toggle="dropdown"
                        class="nav-link dropdown-toggle"
                    >
                        {{ Auth::user()->name }}<span class="caret"></span>
                    </a>
                    <div
                        class="dropdown-menu nav-menu-dropdown-right p-0"
                        aria-labelledby="navbarDropdown"
                    >
                        <a
                            class="dropdown-item py-2 rounded-top"
                            href="{{route('profile')}}"
                        >
                            {{ __('Профиль') }}
                        </a>
                        <hr class="m-0">
                        <a
                            class="dropdown-item py-2 rounded-bottom"
                            href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();"
                        >
                            {{ __('Выход') }}
                        </a>
                        <form
                            method="POST"
                            id="logout-form"
                            style="display: none;"
                            action="{{ route('logout') }}"
                        >
                            @csrf
                        </form>
                    </div>
                </li>
                <img src="{{ Auth::user()->avatar }}" class="rounded-circle navbar-avatar" alt="">
            @endguest
        </ul>
    </div>

    <!-- Left side of navbar -->
    <div
        class="collapse navbar-collapse"
        id="navbarSupportedContent"
    >
        <ul class="nav navbar-links align-items-center small-nav-display">
            @php
                $links = [
                    ['href' => '/', 'imageUrl' => '/img/lafeum-ru-home.png'],
                    ['href' => '/knowledge', 'name' => 'Области Знаний'],
                    ['href' => '/vocabulary', 'name' => 'Словарь'],
                    ['href' => '/quotes', 'name' => 'Цитаты'],
                    ['href' => '/authors', 'name' => 'Авторы'],
                    ['href' => '/videos', 'name' => 'Видео'],
                    ['href' => '/channels', 'name' => 'Каналы'],
                    ['href' => '/terms', 'name' => 'Термины'],
                    ['href' => '/photo', 'name' => 'Фотографии'],
                ];
            @endphp
            @foreach($links as $link)
                <li class="nav-item active">
                    <a class="nav-link text-light" href="{{ $link['href'] }}">
                        @if(array_key_exists('name', $link))
                            {{ $link['name'] }}
                        @else
                            <img style="width: 60px" src="{{ $link['imageUrl'] }}">
                        @endif
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</nav>
{{--@include('layouts.loginModal')--}}
{{--@include('layouts.registerModal')--}}
<script>
    $(document).ready(function () {
        $("#loginBtn").click(function () {
            $("#loginModal").modal();
        });
    });
</script>
