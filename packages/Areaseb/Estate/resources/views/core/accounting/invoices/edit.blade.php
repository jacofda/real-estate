@extends('estate::layouts.app')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{config('app.url')}}invoices">Fatture</a></li>
@stop

@include('estate::layouts.elements.title', ['title' => 'Modifica Fattura N.'.$invoice->numero])


@section('content')

    {!! Form::model($invoice, ['url' => $invoice->url, 'autocomplete' => 'off', 'method' => 'PATCH', 'id' => 'productForm']) !!}
        <div class="row">
            @include('estate::components.errors')
            @include('estate::core.accounting.invoices.form')
        </div>
    {!! Form::close() !!}
@include('estate::core.accounting.invoices.form-components.modal-storno')
@stop
