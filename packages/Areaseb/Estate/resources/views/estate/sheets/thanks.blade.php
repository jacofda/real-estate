<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sheet</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="baseURL" content="{{config('app.url')}}">

    <title>Firma il Foglio di visita</title>

    <link rel="stylesheet" href="{{asset('css/all.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/colors.css')}}">

</head>
<body>
    <div class="container">
        <h1>Firma il Foglio di visita</h1>
        <div class="row">
            <div class="col-12">
                <p>Grazie per aver firmato il foglio di visita</p>
                <a href="{{ route('sheets.download', ['uuid' => $sheet->uuid]) }}" class="btn btn-primary" download>Scarica il documento firmato</a>
            </div>
        </div>
    </div>
</body>
</html>
