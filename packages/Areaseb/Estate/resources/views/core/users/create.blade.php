@extends('estate::layouts.app')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{config('app.url')}}users">Utenti</a></li>
@stop

@include('estate::layouts.elements.title', ['title' => 'Crea Utente'])


@section('content')

    {!! Form::open(['url' => url('users'), 'autocomplete' => 'off', 'id' => 'userForm']) !!}
        <div class="row">
            @include('estate::components.errors')
            @include('estate::core.users.form')
        </div>
    {!! Form::close() !!}

@stop
