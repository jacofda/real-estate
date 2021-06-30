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
    <h1 class="title">Privacy</h1>
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
