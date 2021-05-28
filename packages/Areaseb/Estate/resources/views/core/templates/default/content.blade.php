@extends('estate::core.templates.default.layout')

@section('content')

    {!!Areaseb\Estate\Models\Template::getLastDefaultNewsletter()!!}

@stop
