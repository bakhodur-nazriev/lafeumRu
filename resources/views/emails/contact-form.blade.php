@component('mail::message')
    <strong>Имя: </strong>{{ $data['user_name'] }}<br>
    <strong>Email: </strong>{{ $data['user_email'] }}<br>
    <strong>Тема: </strong>{{ $data['topic'] }}<br>
    <strong>Сообщение: </strong>{{ $data['message'] }}

    @component('mail::button', ['url' => env("APP_URL")."/dashboard/feedbacks"])
        Go to dashboard
    @endcomponent
@endcomponent
