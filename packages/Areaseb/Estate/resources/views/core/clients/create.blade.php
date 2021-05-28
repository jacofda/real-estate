@extends('estate::layouts.app')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{config('app.url')}}clients">Clienti</a></li>
@stop

@include('estate::layouts.elements.title', ['title' => 'Crea Cliente'])


@section('content')

    {!! Form::open(['url' => url('clients'), 'autocomplete' => 'off', 'id' => 'clientForm']) !!}
        <div class="row">
            @include('estate::components.errors')
            @include('estate::core.clients.form')
        </div>
    {!! Form::close() !!}

@stop
