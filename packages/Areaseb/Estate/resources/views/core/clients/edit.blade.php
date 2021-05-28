@extends('estate::layouts.app')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{route('clients.index')}}">Clienti</a></li>
    <li class="breadcrumb-item"><a href="{{$client->url}}">{{$client->rag_soc}}</a></li>
@stop

@include('estate::layouts.elements.title', ['title' => 'Modifica Cliente'])


@section('content')

    {!! Form::model($client, ['url' => $client->url, 'autocomplete' => 'off', 'method' => 'PATCH', 'id' => 'clientForm']) !!}
        <div class="row">
            @include('estate::components.errors')
            @include('estate::core.clients.form')
        </div>
    {!! Form::close() !!}

@stop
