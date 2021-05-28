@extends('estate::layouts.app')

@section('css')
    <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.css')}}">
@stop

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{config('app.url')}}properties">Propietà</a></li>
@stop

@include('estate::layouts.elements.title', ['title' => 'Crea Propietà'])


@section('content')

    {!! Form::open(['url' => route('properties.store'), 'autocomplete' => 'off']) !!}
        <div class="row">
            @include('estate::components.errors')
            @include('estate::estate.properties.form.base')
            @include('estate::estate.properties.form.feats')

        </div>
    {!! Form::close() !!}

@stop
