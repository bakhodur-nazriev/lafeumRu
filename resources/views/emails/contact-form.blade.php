@component('mail::message')
    # Спасибо за ваше письмо!

    <b>Имя: </b>{{ $data['user_name'] }}<br>
    <b>Email: </b>{{ $data['user_email'] }}<br>
    <b>Тема: </b>{{ $data['topic'] }}<br>
    <b>Сообщение: </b>{{ $data['message'] }}
@endcomponent
