<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sheet</title>

    <style>
        @page {
            margin: 0cm 0cm;
        }

        body {
            margin-top: 0.5cm;
            margin-left: 2cm;
            margin-right: 2cm;
            margin-bottom: 0.42cm;
            max-width: 21cm;
        }

        .title {
            text-align: center;
            text-transform: uppercase;
            text-decoration: underline;
        }
        .date {
            font-size: 14pt;
        }

        .data {
            text-transform: uppercase;
            font-weight: 700;
        }

        .text {
            font-size: 12pt;
        }

        .float-left {
            float: left;
        }
        .float-right {
            float: right;
        }
    </style>
</head>
<body>
    <h1 class="title">Foglio di visita</h1>
    <p class="date">Data: {{ now()->format('d/m/Y') }}</p>
    <p class="text">Il sottoscritto <span class="data">{{ $sheet->client->rag_soc }}</span> Domiciliato a <span class="data">{{ $sheet->client->city }} ({{ $sheet->client->province }})</span></p>
    <p class="text">In via <span class="data">{{ $sheet->client->address }}</span></p>
    <p class="text">Cell <span class="data">{{ $sheet->client->phone }}</span> E-mail: <span class="data">{{ $sheet->client->email }}</span></p>
    <br>
    <p class="text">E' alla ricerca di un immobile: in affitto: .... in vendita: ...</p>
    <p class="text">....</p>
    <br>
    <p class="text">Dichiara di aver ricevuto informazioni<br> e di aver visitato con l’Agenzia Immobiliare Cortinese – sede staccata di San Vito di Cadore i seguenti immobili:</p>

    @foreach ($sheet->views as $view)
        <p>{{ $loop->iteration }}) <span class="data">{{ $view->property->name_it }}</span> il giorno <span class="data">{{ $view->created_at->format('d/m/Y') }}</span> alle ore <span class="data">{{ $view->created_at->format('H:i') }}</span></span>
    @endforeach

    <p class="text">Ai sensi dell’art. 13 del D Lgs: 196/2003 autorizzo il trattamento dei miei dati personali al fine di propormi degli immobili come da me richiesti.</p>
    <div class="text">
        <div class="float-left">
            <p>Luogo</p>
            <p class="data">...</p>
        </div>
        <div class="float-right">
            <p>FIRMA</p>
            @if ($sign)
                <p><img src="{{ $sign }}" style="width: 200px;" /></p>
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
</body>
</html>
