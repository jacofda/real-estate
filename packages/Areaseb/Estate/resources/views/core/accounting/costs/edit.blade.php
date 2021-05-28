@extends('estate::layouts.app')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{config('app.url')}}costs">Costi</a></li>
@stop

@include('estate::layouts.elements.title', ['title' => 'Modifica Prodotto'])


@section('content')

    {!! Form::model($cost, ['url' => $cost->url, 'autocomplete' => 'off', 'method' => 'PATCH', 'id' => 'costForm']) !!}
        <div class="row">
            @include('estate::components.errors')
            @include('estate::core.accounting.costs.form')
        </div>
    {!! Form::close() !!}

@stop
