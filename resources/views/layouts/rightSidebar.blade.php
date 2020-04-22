<div class="col-md-3 col-xl-3">
    <div class="card-header">{{ __('Вход') }}</div>
    <div class="card-block">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-0 form-group row">
                <div class="col-md-12">
                    <input
                        id="email"
                        type="email"
                        class="form-control @error('email') is-invalid @enderror"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autocomplete="email"
                        autofocus
                        placeholder="Логин"
                    >
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="mb-0 form-group row">
                <div class="col-md-12">
                    <input
                        id="password"
                        type="password"
                        class="form-control @error('password') is-invalid @enderror"
                        name="password"
                        required
                        autocomplete="current-password"
                        placeholder="Пароль"
                    >
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Login') }}
                    </button>
                </div>
            </div>
        </form>
    </div>


    {{--    <div class="card-block">--}}
    {{--        <input type="text" class="mb-2 form-control" placeholder="Login">--}}
    {{--        <input type="text" class="form-control" placeholder="Password">--}}
    {{--    </div>--}}
</div>

{{--<div class="col-md-8">--}}
{{--    <div class="card">--}}
{{--        <div class="card-header">{{ __('Login') }}</div>--}}

{{--    </div>--}}
{{--</div>--}}
