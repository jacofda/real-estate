@extends('estate::layouts.app')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{config('app.url')}}roles">Ruoli</a></li>
@stop

@include('estate::layouts.elements.title', ['title' => 'Modifica Ruolo'])


@section('content')

    {!! Form::model($role, ['url' => url('roles/'.$role->id), 'autocomplete' => 'off', 'method' => 'PATCH', 'id' => 'roleForm']) !!}
        <div class="row">
            @include('estate::components.errors')
            @include('estate::core.roles.form')
        </div>
    {!! Form::close() !!}

@stop
