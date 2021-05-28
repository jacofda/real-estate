@component('mail::message')
# Fattura di cortesia

Spett. {{$client->rag_soc}},<br>


Grazie,<br>
{{ config('app.name') }}
@endcomponent
