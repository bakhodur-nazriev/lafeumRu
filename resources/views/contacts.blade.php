@extends('layouts.default')

@section('meta-tags')
    @include('layouts.meta-tags', [
        'title' => "Контакты.",
    ])
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12 col-lg-8">
            <h3 class="secondary">Контакты</h3>
            <p>Мы рады, что Вы посетили наш сайт и ознакомились с находящейся на нем информацией.
                Вся информация находится в свободном доступе и предназначена только для частного пользования.
                Если Вы считаете, что Ваша работа была размещена на нашем сайте в нарушение Вашего авторского права,
                сообщите нам об этом, используя обратную связь.
                Будем рады рассмотреть Ваши рекомендации по усовершенствованию сайта.</p>
            <p><a href="mailto:info@lafeum.org">info@lafeum.org</a></p>
        </div>
        <div class="col-sm-12 col-lg-4">
            <h3 class="mb-4 secondary">Свяжитесь с нами</h3>
            <div class="contact-form-block">
                <form method="POST">
                    <div class="form-group">
                        <label for="user_name">Ваше имя</label>
                        <input type="text" name="user_name" class="form-control">
                        <div>{{ $errors->first('user_name') }}</div>
                    </div>
                    <div class="form-group">
                        <label for="user_email">Ваша почта</label>
                        <input type="email" name="user_email" class="form-control">
                        <div>{{ $errors->first('user_email') }}</div>
                    </div>
                    <div class="form-group">
                        <label for="topic">Тема</label>
                        <input type="text" name="topic" class="form-control">
                        <div>{{ $errors->first('topic') }}</div>
                    </div>
                    <div class="form-group">
                        <label for="message">Сообщение</label>
                        <textarea class="form-control" id="message" name="message" rows="3">
                            {{ old('message') }}
                        </textarea>
                        <div>{{ $errors->first('message') }}</div>
                    </div>

                    @csrf

                    <button type="submit" class="btn btn-light">Отправить</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('right-side-bar')@endsection