@extends('estate::layouts.app')

@include('estate::layouts.elements.title', ['title' => 'Dashboard'])

@section('content')
    <div class="row">
        @if($view->clients)
            @can('companies.read')
                @include('estate::home-components.companies')
            @endcan
            @can('contacts.read')
                @include('estate::home-components.contacts')
            @endcan
        @endif

        @if($view->invoices)
            @can('costs.read')
                @include('estate::home-components.costi-in-scadenza')
            @endcan
            @can('invoices.read')
                @include('estate::home-components.fatture-in-scadenza')
            @endcan
        @endif

        @isset($view->killer_quote)
            @if($view->killer_quote)
                @includeIf('killerquote::dashboard')
            @endif
        @endisset

        @if($view->events)
            @includeIf('estate::core.events.dashboard')
        @endif

        @isset($view->renewals)
            @if($view->renewals)
                @includeIf('renewals::dashboard')
            @endif
        @endisset

        @isset($view->projects)
            @if($view->projects)
                @includeIf('projects::dashboard')
            @endif
        @endisset



    </div>
@stop


@section('scripts')
    <script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>
@stop
