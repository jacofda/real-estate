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

        p {
            margin: 0;
            font-size: 12pt;
        }

        .bold {
            font-weight: bold;
        }

        .title {
            text-align: center;
            text-transform: uppercase;
            text-decoration: underline;
        }

        .date {
            font-size: 14pt;
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
    <p class="date">Data: <span class="bold">{{ now()->format('d/m/Y') }}</span></p>
    <p>Il sottoscritto <span class="bold">{{ $sheet->client->rag_soc }}</span> Domiciliato a <span class="bold">{{ $sheet->client->city }} ({{ $sheet->client->province }})</span></p>
    <p>In via <span class="bold">{{ $sheet->client->address }}</span></p>
    <p>Cell <span class="bold">{{ $sheet->client->phone }}</span> E-mail: <span class="bold">{{ $sheet->client->email }}</span></p>
    <br>
    <p>E' alla ricerca di un immobile: in affitto: .... in vendita: ...</p>
    <p>Localizzato a: .....</p>
    <p>Con le seguenti caratteristiche: ....</p>
    <br>
    <p>Dichiara di aver ricevuto informazioni<br> e di aver visitato con l’Agenzia Immobiliare Cortinese – sede staccata di San Vito di Cadore i seguenti immobili:</p>
    <br>
    @foreach ($sheet->views as $view)
        <p>{{ $loop->iteration }}) <span class="bold">{{ $view->property->name_it }}</span> il giorno <span class="bold">{{ $view->created_at->format('d/m/Y') }}</span> alle ore <span class="bold">{{ $view->created_at->format('H:i') }}</span></span>
    @endforeach

    <br>
    <br>
    <p class="bold">Ai sensi dell’art. 13 del D Lgs: 196/2003 autorizzo il trattamento dei miei dati personali al fine di propormi degli immobili come da me richiesti.</p>
    <br>
    <br>
    <div>
        <div class="float-left">
            <p>Luogo</p>
            <p class="bold">...</p>
        </div>
        <div class="float-right" style="width: 200px;">
            <p>FIRMA</p>
            <br>
            @if ($sign)
                <img src="{{ $sign }}" style="width: 100%" />
            @endif
        </div>
    </div>

</body>
</html>
