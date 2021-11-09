@component('mail::message')
    <h1>Вы получили письмо от: <span style="font-weight: normal;">{{ $data['user_name'] }}</span></h1>
    <p><strong>Имя:</strong> {{ $data['user_name'] }}</p>
    <p><strong>Email:</strong> {{ $data['user_email'] }}</p>
    <p><strong>Тема: </strong>{{ $data['topic'] }}</p>
    <p><strong>Сообщение:</strong> {{ $data['message'] }}</p>
@endcomponent