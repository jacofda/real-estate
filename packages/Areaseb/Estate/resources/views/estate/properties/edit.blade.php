@extends('estate::layouts.app')

@section('css')
    <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.css')}}">
@stop

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{config('app.url')}}properties">Propietà</a></li>
    <li class="breadcrumb-item"><a href="{{route('properties.show', $property->id)}}">{{$property->rif}}</a></li>
@stop

@include('estate::layouts.elements.title', ['title' => 'Modifica Propietà'])


@section('content')

    {!! Form::model($property, ['url' => route('properties.update', $property->id), 'autocomplete' => 'off', 'method' => 'PATCH']) !!}
        <div class="row">
            @include('estate::components.errors')
            @include('estate::estate.properties.form.base')
            @include('estate::estate.properties.form.feats')
        </div>
    {!! Form::close() !!}

@stop
