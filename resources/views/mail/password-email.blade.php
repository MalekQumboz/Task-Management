@component('mail::message')
# Welcome {{$name}}

We are happy to see you.

@component('mail::panel')
your account password is: {{$password}}.
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
