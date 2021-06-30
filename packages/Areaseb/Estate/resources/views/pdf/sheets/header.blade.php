<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>header</title>

    <style>
        .header {
            font-style: italic;
            font-weight: bold;
            opacity: 1;
        }

        .logo {
            padding-right: 20px;
            float: left;
        }

        .logo img {
            height: 190px;
        }

        .text {
            padding-top: 13px;
        }

        .title {
            font-size: 12pt;
        }

        .title .name {
            font-size: 14pt;
        }

        .title .owner {
            font-size: 9pt;
        }

        p {
            margin: 0;
        }

        .subtitle {
            font-size: 10pt;
        }

        .subtitle .separator {
            margin: 0 16px;
        }

        .headquarters {
            margin-top: 20px;
            font-size: 9pt;
        }

        .headquarters > div:first-child {
            margin-right: 20px;
            float: left;
        }

        .headquarters .email {
            font-size: 10pt;
            font-weight: normal;
            font-style: normal;
        }
    </style>
</head>
<body>

<header class="header">
    <div class="logo">
        <img src="{{asset('/css/pdf/logo.png')}}">
    </div>
    <div class="text">
        <p class="title"><span class="name">AGENZIA CORTINESE</span> Immobiliare <span class="owner">di G. Belli</span></p>
        <p class="subtitle">compravendite immobiliari</p>
        <p class="subtitle">affitti stagionali</p>
        <p class="subtitle">amministrazioni condominiali <span class="separator">-</span> L.14.1.2013 n. 4</p>

        <div class="headquarters">
            <div>
                <p>32043 CORTINA D’AMPEZZO</p>
                <p>P.tta S. Francesco, 15</p>
                <p>Tel. 0436 863886 • Fax 0436 867554</p>
                <p class="email">E-mail: agenzia@cortinese.it</p>
            </div>
            <div>
                <p>32046 SAN VITO DI CADORE</p>
                <p>Corso Italia, 8
                <p>Tel. 0436 99020 • Fax 0436 898042
                <p class="email">E-mail: agsanvito@cortinese.it</p>
            </div>
        </div>
    </div>
</header>

</body>
</html>
