@extends('estate::layouts.app')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{config('app.url')}}roles">Ruoli</a></li>
@stop

@include('estate::layouts.elements.title', ['title' => 'Crea Ruolo'])


@section('content')

    {!! Form::open(['url' => url('roles'), 'autocomplete' => 'off', 'id' => 'userForm']) !!}
        <div class="row">
            @include('estate::components.errors')
            @include('estate::core.roles.form')
        </div>
    {!! Form::close() !!}

@stop
