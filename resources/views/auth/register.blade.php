@extends('layouts.empty')

@section('content')
    <register></register>
    <!-- <div class="row justify-content-center my-3">
        <div class="col-md-6">
            <h4 class="title-pages">регисрация</h4>
        </div>
    </div>
    <div class="row justify-content-center mt-2 mb-4">
        <div class="col-md-6 bg-default" style="padding: 50px 80px">
            <div class="col-md-12 text-md-left">
                <h1>{{ __('Регистрация') }}</h1>
                <h6 class="mb-0 own-text-secondary-color font-weight-light">У Вас есть аккаунт?</h6>
            </div>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group mb-0">
                    <div class="col-md-12">
                        <label
                            for="name"
                            class="col-md-12 col-form-label text-left default-label own-text-secondary-color px-0 pt-0"
                        >
                            {{ __('Имя, Фамилия') }}
                        </label>
                        <input
                            required
                            autofocus
                            id="name"
                            name="name"
                            type="text"
                            autocomplete="name"
                            value="{{ old('name') }}"
                            placeholder="{{ __('Введите ваш имя,фамилия') }}"
                            class="form-control @error('name') is-invalid @enderror"
                        >
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group mb-0">
                    <div class="col-md-12">
                        <label
                            for="email"
                            class="col-md-12 col-form-label default-label own-text-secondary-color text-left px-0 pt-0"
                        >
                            {{ __('Ваш Email') }}
                        </label>
                        <input
                            required
                            id="email"
                            type="email"
                            name="email"
                            autocomplete="email"
                            value="{{ old('email') }}"
                            placeholder="{{ __('Введите ваш email') }}"
                            class="form-control @error('email') is-invalid @enderror"
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
                            class="col-md-12 col-form-label text-left default-label own-text-secondary-color px-0 pt-0"
                        >
                            {{ __('Пароль') }}
                        </label>
                        <input
                            required
                            id="password"
                            type="password"
                            name="password"
                            placeholder="{{ __('Введите ваш пароль') }}"
                            autocomplete="new-password"
                            class="form-control @error('password') is-invalid @enderror"
                        >
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group mb-0">
                    <div class="col-md-12">
                        <label
                            for="password-confirm"
                            class="col-md-12 col-form-label default-label own-text-secondary-color text-left px-0 pt-0"
                        >
                            {{ __('Подтверждения пароля') }}
                        </label>
                        <input
                            required
                            type="password"
                            class="form-control"
                            id="password-confirm"
                            placeholder="{{ __('Подтвердите ваш пароль') }}"
                            autocomplete="new-password"
                            name="password_confirmation"
                        >
                    </div>
                </div>
                <div class="form-group mb-0 mt-2">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary w-100 btn-login-default">{{ __('Регистрация') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div> -->
@endsection
