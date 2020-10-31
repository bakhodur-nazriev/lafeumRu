@component('mail::message')
# Thank you for your message

<strong>Имя: </strong>{{ $data['user_name'] }}<br>
<strong>Email: </strong>{{ $data['user_email'] }}<br>
<strong>Тема: </strong>{{ $data['topic'] }}<br>
<strong>Сообщение: </strong>{{ $data['message'] }}
@endcomponent
