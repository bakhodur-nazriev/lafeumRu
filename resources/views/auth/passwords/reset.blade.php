@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Сбросить пароль') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="form-group row">
                                <label
                                    for="email"
                                    class="col-md-4 col-form-label text-md-right"
                                >{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input
                                        required
                                        autofocus
                                        id="email"
                                        type="email"
                                        name="email"
                                        autocomplete="email"
                                        value="{{ $email ?? old('email') }}"
                                        class="form-control @error('email') is-invalid @enderror"
                                    >

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label
                                    for="password"
                                    class="col-md-4 col-form-label text-md-right"
                                >{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input
                                        required
                                        id="password"
                                        type="password"
                                        name="password"
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

                            <div class="form-group row">
                                <label
                                    for="password-confirm"
                                    class="col-md-4 col-form-label text-md-right"
                                >{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input
                                        required
                                        type="password"
                                        class="form-control"
                                        id="password-confirm"
                                        autocomplete="new-password"
                                        name="password_confirmation"
                                    >
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Reset Password') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
