@component('mail::message')
Hello, {{$user->name}}!

We are glad that you helped us to expand our great team of physicits.
We hope that you will gain knowledge and share knowledge.

@component('mail::button', ['url' => 'http://localhost:8000/'])
Go to our site :)
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
