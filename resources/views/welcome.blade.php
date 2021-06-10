@extends('layouts.app')

@section('meta')
    <title>CORTINESE HOME</title>

@stop

@section('slide')
    @include('elements.home.slide')
@stop

@section('content')

    @include('properties.index.search', ['url' => route(app()->getLocale().'.immobili'), 'contracts' => [''=>__('Qualsiasi'), 1=>__('Vendita'), 0 => __('Affitto')]])

    @include('elements.home.categories')

    @include('elements.home.highlighted')

    @include('elements.home.discounted')

@stop
