@component('mail::message')
# Richiesta Contatti

The body of your message.

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Grazie,<br>
{{ config('app.name') }}
@endcomponent
