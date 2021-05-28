<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="baseURL" content="{{config('app.url')}}">
    <meta name="iva" content="{{config('app.iva')}}">
    <meta name="token" content="{{csrf_token()}}">

    @yield('meta_title')

    <link rel="stylesheet" href="{{asset('css/all.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/colors.css')}}">

    @yield('css')

</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        @include('estate::layouts.elements.top-nav')

        @include('estate::layouts.elements.side-nav')

        <div class="content-wrapper">

            @yield('title')

            <section class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </section>

        </div>

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.0
            </div>
            <strong>Copyright &copy; 2020 - @if(date('Y') != '2020') {{date('Y')}} | @endif
                @if(strpos(config('app.url'), 'crmbia.it') !== false)
                    <a href="https://www.prima-posizione.it/">Imprenditori in azione</a>.
                @else
                    <a href="https://www.areaseb.it">Areaseb srl</a>.
                @endif
            </strong> Tutti i diritti riservati.
        </footer>

    </div>

<div class="modal" tabindex="-1" role="dialog" id="global-modal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Chiudi</button>
                <button type="submit" class="btn btn-primary btn-save-modal">Salva</button>
            </div>
        </div>
    </div>
</div>

    <script src="{{asset('js/all.js')}}"></script>

    <script src="https://unpkg.com/inputmask@4.0.4/dist/inputmask/dependencyLibs/inputmask.dependencyLib.js"></script>
    <script src="https://unpkg.com/inputmask@4.0.4/dist/inputmask/inputmask.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lazyload@2.0.0-rc.2/lazyload.js"></script>
    <script src="https://unpkg.com/inputmask@4.0.4/dist/inputmask/inputmask.date.extensions.js"></script>

    <script src="{{asset('js/adminlte.min.js')}}"></script>
    <script src="{{asset('js/global.js')}}"></script>
    @yield('scripts')
    @stack('scripts')
    @include('estate::components.session')

</body>
