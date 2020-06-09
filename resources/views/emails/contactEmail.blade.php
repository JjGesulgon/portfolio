@component('mail::message')
{{-- jjgesulgon.dev Contact Page --}}

<h2>Message</h2>

{{ $message }}

<br>

{{-- <h2>Call Stats</h2>
@component('mail::table')
| Skill               | Proficiency      | Years    |
| ------------------- |:----------------:| --------:|
| PHP                 | 9                | 5        |
| Laravel             | 9                | 4        |
| MySQL               | 8                | 5        |
@endcomponent --}}

{{-- @component('mail::button', "Hello JJ")
View on Resume
@endcomponent --}}

Thanks,<br>
{{ $name }} <br>
{{ $email }}
{{-- {{ config('app.name') }} --}}
@endcomponent