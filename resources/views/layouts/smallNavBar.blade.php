@php
    $navItems = [
        "Главная" => url('/'),
        "Области Знаний" => url('/knowledge'),
        "Цитаты" => url('/quotes'),
        "Словарь" => url('/vocabulary'),
        "Авторы" => url('/authors'),
        "Видео" => url('/videos'),
        "Каналы" => url('/channels'),
        "Термины" => url('/terms'),
        "Фотографии" => url('/photo'),
        "Контакты" => url('/contacts'),
    ];
@endphp

<div class="menu-toggle-btn navbar-dark text-center">
    <button
        type="button"
        aria-expanded="false"
        class="navbar-toggler p-0"
        data-toggle="modal"
        data-target="#myModal"
        aria-label="{{ __('Toggle navigation') }}"
    >
        <span class="fa fa-bars text-light display-5"></span>
    </button>
    <div>
        <a href="/" class="text-light mr-2">Главная</a>
        <a class="text-light" href="/knowledge">Области Знаний</a>
    </div>
    {{--<span>{{ array_search(url()->current(), $navItems) }}</span>
        <span>{{ array_search(url()->current(), $navItems) }}</span>--}}
</div>

<!-- Modal -->
<div
    class="modal left fade"
    id="myModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="myModalLabel"
>
    <div
        class="modal-dialog"
        role="document"
    >
        <div class="modal-content">
            <div class="modal-header small-modal-header-navbar">
                <button
                    type="button"
                    class="close m-0 p-0"
                    data-dismiss="modal"
                    aria-label="Close"
                >
                    <span aria-hidden="true">&times;</span>
                </button>
                <div>
                    <ul class="navbar-nav ml-auto">
                        @guest
                            <button
                                data-toggle="modal"
                                data-target="#loginModal"
                                class="btn btn-primary border-0"
                            >
                                Вход
                            </button>
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
                                    style="color: #04718c;"
                                >
                                    {{ Auth::user()->name }}<span class="caret"></span>
                                </a>
                                <div class="dropdown-menu nav-menu-dropdown-right p-0 rounded-0"
                                     aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item py-2"
                                       href="{{route('dashboard')}}">{{ __('Личный Кабинет') }}</a>
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
            </div>

            <div class="modal-body">
                <ul class="nav navbar-links small-nav-display">
                    @foreach($navItems as $name => $href)
                        <li class="nav-item">
                            <a class="nav-link small-nav-item" href="{{ $href }}">
                                {{ $name }}
                                <span class="fa fa-angle-right"></span>
                            </a>
                        </li>
                        <div class="dropdown-divider"></div>
                    @endforeach
                </ul>
            </div>
        </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div><!-- modal -->
