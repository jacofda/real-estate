@component('mail::message')
# Foglio di visita da firmare

Spett. {{ $sheet->client->rag_soc }},<br>
clicca sul bottone per firmare il foglio di visita

@component('mail::button', ['url' => $url])
Firma
@endcomponent

Grazie,<br>
{{ config('app.name') }}
@endcomponent
