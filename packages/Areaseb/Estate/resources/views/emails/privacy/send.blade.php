@component('mail::message')
# Privacy da firmare

Spett. {{ $privacy->client->rag_soc }},<br>
clicca sul bottone per firmare la privacy

@component('mail::button', ['url' => $url])
Firma
@endcomponent

Grazie,<br>
{{ config('app.name') }}
@endcomponent
