@component('mail::message')
{{-- jjgesulgon.dev Contact Page
<br> --}}

<h2>Subscriber Message</h2>

{{ $body }}

{{-- <br> --}}

{{-- <h2>Call Information</h2>
@component('mail::table')
|              |                               |
| ------------ |:-----------------------------:|
| Name         | Gether Kestrel B. Medel       |
| Age          | 25                            |
| Job          | Pole Dancing                  |
@endcomponent

<h2>Call Stats</h2>
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
{{ config('app.name') }}
@endcomponent