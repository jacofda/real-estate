@extends('estate::layouts.app')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{config('app.url')}}expenses">Spese</a></li>
@stop

@include('estate::layouts.elements.title', ['title' => 'Crea Spesa'])


@section('content')

    {!! Form::open(['url' => url('expenses'), 'autocomplete' => 'off', 'id' => 'expenseForm']) !!}
        <div class="row">
            @include('estate::components.errors')
            @include('estate::core.accounting.expenses.form')
        </div>
    {!! Form::close() !!}

@stop
