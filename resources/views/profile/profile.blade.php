@extends('layouts.empty')

@section('content')
    <div class="row">
        <div class="col-md-12 my-3">
            <h4 class="title-pages">Профиль</h4>
        </div>
    </div>
    <div class="row justify-content-center">
        @include('profile.profile-left-sidebar')
        <div class="col-md-8 px-5 py-4 bg-default">
            <form method="POST" action="/profile/{{ Auth::user()->id }}">
                @csrf
                @method('PUT')
                <div class="form-group mb-4">
                    <p>Изменить фотографию профиля</p>
                    <div class="avatar-and-actions-block">
                        <img class="rounded-circle mr-4" style="width: 83px;" src="{{ Auth::user()->avatar }}" alt="">
                        <label for="myFile" class="choose profile-right-buttons mr-3 py-2 px-4">Изменить
                            аватарку</label>
                        <input type="file" class="my" id="myFile" name="avatar" multiple="multiple"/>
                        <a class="btn px-4 profile-right-buttons"
                           href="/profile/{{ Auth::user()->id }}/edit">Удалить</a>
                    </div>
                </div>
            </form>
            <form method="POST" action="/profile/{{ Auth::user()->id }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name" class="col-form-label profile-right-labels">
                        {{ __('Имя пользователя*') }}
                    </label>
                    <div class="d-flex align-items-center">
                        <div class="col-md-8 p-0">
                            <input
                                required
                                autofocus
                                id="name"
                                type="name"
                                name="name"
                                autocomplete="name"
                                value="{{ Auth::user()->name }}"
                                class="form-control @error('name') is-invalid @enderror profile-right-input"
                            >
                        </div>
                        <div class="col-md-4 p-0 d-flex justify-content-end">
                            <button type="submit" class="btn profile-right-buttons">Сохранить
                                изменения
                            </button>
                        </div>
                    </div>
                </div>
            </form>
            <form method="POST" action="/profile/{{ Auth::user()->id }}">
                @csrf
                @method('PUT')
                <div class="form-group align-items-center">
                    <label for="email" class="col-form-label profile-right-labels">
                        {{ __('Адрес E-Mail') }}
                    </label>
                    <div class="d-flex align-items-center">
                        <div class="col-md-8 p-0">
                            <input
                                required
                                autofocus
                                id="email"
                                type="email"
                                name="email"
                                autocomplete="email"
                                value="{{ Auth::user()->email }}"
                                class="form-control @error('email') is-invalid @enderror profile-right-input"
                            >
                        </div>
                        <div class="col-md-4 p-0 d-flex justify-content-end">
                            <button type="submit" class="btn ml-3 profile-right-buttons">Сохранить
                                изменения
                            </button>
                        </div>
                    </div>
                </div>
            </form>
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <form method="POST" action="/profile/{{ Auth::user()->id }}">
                @csrf
                @method('PUT')
                <div class="form-group align-items-center">
                    <label for="password" class="col-form-label profile-right-labels">
                        {{ __('Пароль') }}
                    </label>
                    <div class="d-flex">
                        <div class="col-md-8 p-0">
                            <input
                                required
                                id="password"
                                type="password"
                                name="password"
                                autocomplete="current-password"
                                class="form-control @error('password') is-invalid @enderror profile-right-input "
                            >
                        </div>
                        <div class="col-md-4 p-0 d-flex justify-content-end">
                            <button type="submit" class="btn ml-3 profile-right-buttons">Сохранить
                                изменения
                            </button>
                        </div>
                    </div>
                </div>
            </form>
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
@endsection
