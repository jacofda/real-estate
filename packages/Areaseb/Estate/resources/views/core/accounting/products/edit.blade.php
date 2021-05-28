@extends('estate::layouts.app')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{config('app.url')}}products">Prodotti</a></li>
        <li class="breadcrumb-item"><a href="{{$product->url}}">{{$product->nome}}</a></li>
@stop

@include('estate::layouts.elements.title', ['title' => 'Modifica Prodotto'])


@section('content')

    {!! Form::model($product, ['url' => $product->url, 'autocomplete' => 'off', 'method' => 'PATCH', 'id' => 'productForm']) !!}
        <div class="row">
            @include('estate::components.errors')
            @include('estate::core.accounting.products.form')
        </div>
    {!! Form::close() !!}

@stop
