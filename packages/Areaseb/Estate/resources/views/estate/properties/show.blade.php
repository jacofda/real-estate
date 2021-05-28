@extends('estate::layouts.app')

@include('estate::layouts.elements.title', ['title' => 'Proprietà rif.' . $property->rif])

@section('css')
    <link rel="stylesheet" href="{{asset('calendar/css/app.css')}}">
<style>.product-image{max-height:400px;height:100%;width:auto;display: block;margin-left: auto;margin-right: auto;text-align: center;}</style>
@stop


@section('content')
    <div class="row">
        @include('estate::estate.properties.show.images')
        @include('estate::estate.properties.show.base')

    </div>
    <div class="row">

        {{-- @include('estate::estate.properties.show.requests') --}}
        {{-- @include('estate::estate.properties.show.tabs') --}}
    </div>
@stop

@section('scripts')

    <script src="{{asset('js/global-properties.js')}}"></script>
    <script>Inputmask().mask("input");</script>
@stop
