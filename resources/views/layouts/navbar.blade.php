<nav class="navbar navbar-expand-md navbar-light shadow-sm main-navbar py-4">
    <div class="menu-toggle-btn navbar-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>

    <!-- Right Side Of Navbar -->
    <div>
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="nav-link text-light" href="{{ route('login') }}">{{ __('Вход') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link text-light" href="{{ route('register') }}">{{ __('Регистарция') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                       data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}<span class="caret"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{route('dashboard')}}">{{ __('Кабинет') }}</a>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        @can("manage-users")
                            <a class="dropdown-item" href="{{route("admin.users.index")}}">
                                User Manager
                            </a>
                        @endcan

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
    </div>
    <!-- Left of Navbar -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="nav navbar-links small-nav-display">
            <li class="nav-item">
                <a class="nav-link text-light" href="{{ url('/') }}">Главная</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="{{ url('/quotes') }}">Цитаты</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="{{ url('/authors') }}">Авторы</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="{{ url('/terms') }}">Термины</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="{{ url('/vocabulary') }}">Словарь</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="{{ url('/knowledges') }}">Области Знаний</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="{{ url('/videos') }}">Видео</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="{{ url('/channels') }}">Каналы</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="{{ url('/photos') }}">Фотографии</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="{{ url('/contacts') }}">Контакты</a>
            </li>
        </ul>
    </div>
</nav>
