<nav class="navbar navbar-expand-lg navbar-light main-navbar">
    <!-- Right Side Of Navbar -->
    @include('layouts.smallNavBar')
    <div class="navbar-login-block">
        <ul class="navbar-nav ml-auto">
            @guest
                <button
                    data-toggle="modal"
                    data-target="#loginModal"
                    class="text-light navbar-login-button py-1 px-3"
                >
                    Вход
                </button>
                @if (Route::has('register'))
                    <button
                        data-toggle="modal"
                        data-target="#registerModal"
                        class="text-light navbar-register-button"
                    >
                        Регистрация
                    </button>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a
                        v-pre
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
                    <div class="dropdown-menu nav-menu-dropdown-right p-0 rounded-0" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item py-2" href="{{route('dashboard')}}">{{ __('Личный Кабинет') }}</a>
                        <a
                            class="dropdown-item py-2"
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
            @endguest
        </ul>
    </div>

    <!-- Left side of navbar -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="nav navbar-links small-nav-display">
            @php
                $links = [
                    ['href' => '/', 'name' => 'Главная'],
                    ['href' => '/knowledge', 'name' => 'Области Знаний'],
                    ['href' => '/vocabulary', 'name' => 'Словарь'],
                    ['href' => '/quotes', 'name' => 'Цитаты'],
                    ['href' => '/authors', 'name' => 'Авторы'],
                    ['href' => '/videos', 'name' => 'Видео'],
                    ['href' => '/channels', 'name' => 'Каналы'],
                    ['href' => '/terms', 'name' => 'Термины'],
                    ['href' => '/photo', 'name' => 'Фотографии'],
                    ['href' => '/contacts', 'name' => 'Контакты'],
                ];
            @endphp
            @foreach($links as $link)
                <li class="nav-item active">
                    <a class="nav-link text-light" href="{{ $link['href'] }}">{{ $link['name'] }}</a>
                </li>
            @endforeach
        </ul>
    </div>
</nav>
<script>
    $(document).ready(function () {
        $("#loginBtn").click(function () {
            $("#loginModal").modal();
        });
    });
</script>
