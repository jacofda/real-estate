@extends('estate::layouts.app')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{config('app.url')}}contacts">Contatti</a></li>
@stop

@include('estate::layouts.elements.title', ['title' => 'Crea Contatto'])


@section('content')

    {!! Form::open(['url' => url('contacts'), 'autocomplete' => 'off', 'id' => 'contactForm']) !!}
        <div class="row">
            @include('estate::components.errors')
            @include('estate::core.contacts.form')
        </div>
    {!! Form::close() !!}

@stop
