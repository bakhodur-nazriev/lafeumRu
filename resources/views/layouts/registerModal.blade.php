<div
    tabindex="-1"
    role="dialog"
    aria-hidden="true"
    id="registerModal"
    aria-labelledby="staticBackdropLabel"
    class="modal fade pr-0 overflow-hidden"
>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Форма регистрация</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('register') }}">
                <div class="modal-body">
                    @csrf
                    <label for="user-name" class="col-form-label text-md-left py-1">{{ __('Имя') }}</label>
                    <input
                        required
                        autofocus
                        name="name"
                        type="text"
                        id="user-name"
                        autocomplete="name"
                        value="{{ old('name') }}"
                        class="form-control mb-2 @error('name') is-invalid @enderror"
                    >
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <label for="user-email"
                           class="col-form-label text-md-left py-1">{{ __('E-Mail Адрес') }}</label>
                    <input
                        required
                        name="email"
                        type="email"
                        id="user-email"
                        class="form-control mb-2 @error('email') is-invalid @enderror"
                        value="{{ old('email') }}"
                        autocomplete="email"
                    >
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <label for="user-password" class="col-form-label text-md-left py-1">{{ __('Пароль') }}</label>
                    <input
                        required
                        id="user-password"
                        type="password"
                        name="password"
                        autocomplete="new-password"
                        class="form-control mb-2 @error('password') is-invalid @enderror"
                    >
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <label
                        for="password-confirm"
                        class="col-form-label text-md-left py-1"
                    >{{ __('Подтвердите Пароль') }}</label>
                    <input
                        required
                        type="password"
                        id="password-confirm"
                        class="form-control mb-2"
                        autocomplete="new-password"
                        name="password_confirmation"
                    >

                    <div class="custom-control custom-checkbox mr-sm-2">
                        <input
                            required
                            type="checkbox"
                            name="privacy_policy"
                            id="privacy_policy"
                            value="{{old('option')}}"
                            class="form-check-input custom-control-input m-0"
                            @if(old('privacy_policy')) checked @endif value="1"
                        >
                        <label
                            for="privacy_policy"
                            class="custom-control-label col-form-label text-md-left py-0"
                        >
                            {{ __('Создавая аккаунт, я принимаю условия, изложенные в') }}
                            <a href="/terms-of-use">полльзовательском соглашении</a> и даю согласие на
                            <a href="/privacy-policy">обработку персональных данных.</a>
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-primary">{{ __('Регистрация') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
