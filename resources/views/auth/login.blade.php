@extends('layouts.default-empty')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6 my-3">
            <h4 class="title-pages">логин</h4>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6 bg-default" style="padding: 50px 80px">
            <div class="col-md-12 text-md-left">
                <h1>{{ __('Вход') }}</h1>
                <h6 class="mb-0 own-text-secondary-color font-weight-light">Добро пожаловать, мы ждали Вас !</h6>
            </div>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group mb-0">
                    <div class="col-md-12">
                        <label
                            for="email"
                            class="col-md-12 col-form-label text-left default-label own-text-secondary-color px-0"
                        >
                            {{ __('Ваш Email') }}
                        </label>
                        <input
                            required
                            autofocus
                            id="email"
                            type="email"
                            name="email"
                            autocomplete="email"
                            value="{{ old('email') }}"
                            placeholder="{{ __('Email') }}"
                            class="form-control default-input @error('email') is-invalid @enderror"
                        >
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group mb-0">
                    <div class="col-md-12">
                        <label
                            for="password"
                            class="col-md-12 col-form-label text-left default-label own-text-secondary-color px-0"
                        >
                            {{ __('Пароль') }}
                        </label>
                        <input
                            required
                            id="password"
                            name="password"
                            type="password"
                            autocomplete="current-password"
                            placeholder="{{ __('Введите Ваш пароль') }}"
                            class="form-control @error('password') is-invalid @enderror"
                        >
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12 form-group mb-0 d-flex justify-content-between">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                        <label class="form-check-label own-text-secondary-color" for="defaultCheck1">Запомнить
                            меня</label>
                    </div>
                    <div><a href="" class="own-text-warning-color">Забыли пароль?</a></div>
                </div>
                <div class="form-group">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary w-100 btn-login-default">{{ __('Вход') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
