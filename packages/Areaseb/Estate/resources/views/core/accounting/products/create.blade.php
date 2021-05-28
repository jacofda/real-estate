@extends('estate::layouts.app')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{config('app.url')}}products">Prodotti</a></li>
@stop

@include('estate::layouts.elements.title', ['title' => 'Crea Prodotto'])


@section('content')

    {!! Form::open(['url' => url('products'), 'autocomplete' => 'off', 'id' => 'productForm']) !!}
        <div class="row">
            @include('estate::components.errors')
            @include('estate::core.accounting.products.form')
        </div>
    {!! Form::close() !!}

@stop
