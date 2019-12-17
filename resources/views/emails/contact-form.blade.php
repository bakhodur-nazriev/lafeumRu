@component('mail::message')
# Thank you for your message

<strong>Имя: </strong>{{ $data['name'] }}<br>
<strong>Email: </strong>{{ $data['email'] }}<br>
<strong>Тема: </strong>{{ $data['theme'] }}<br>
<strong>Сообщение: </strong>{{ $data['message'] }}
@endcomponent
