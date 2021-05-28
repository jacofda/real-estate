@extends('estate::layouts.app')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{config('app.url')}}invoices">Fatture</a></li>
@stop

@include('estate::layouts.elements.title', ['title' => 'Crea Fattura'])


@section('content')

    {!! Form::open(['url' => url('invoices'), 'autocomplete' => 'off', 'id' => 'invoiceForm', 'class' => 'form-horizontal']) !!}
        <div class="row">
            @include('estate::components.errors')
            @include('estate::core.accounting.invoices.form')
        </div>
    {!! Form::close() !!}



@include('estate::core.accounting.invoices.form-components.modal-storno')

@stop
