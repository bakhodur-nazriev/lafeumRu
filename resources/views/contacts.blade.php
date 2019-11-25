@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-7 col-xl-6 offset-xl-1">
                <h3>Контакты</h3>
                <p>Мы рады, что Вы посетили наш сайт и ознакомились с находящейся на нем информацией.
                    Вся информация находится в свободном доступе и предназначена только для частного пользования.
                    Если Вы считаете, что Ваша работа была размещена на нашем сайте в нарушение Вашего авторского права, сообщите нам об этом, используя обратную связь.
                    Будем рады рассмотреть Ваши рекомендации по усовершенствованию сайта.</p>
                    <p>
                        <a href="#">info@lafeum.org</a>
                    </p>
            </div>
            <div class="col-md-4 col-xl-3 offset-xl-1">
                <h3>Свяжитесь с нами</h3>
                <div class="contact-form-block">
                    <form>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Ваше имя</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Ваша почта</label>
                            <input type="email" class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Тема</label>
                            <input type="text" class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Сообщение</label>
                            <input type="email" class="form-control" id="exampleInputPassword1">
                        </div>

                        <button type="submit" class="btn btn-light">Отправить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
