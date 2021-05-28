@extends('estate::layouts.app')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{route('properties.index')}}">Proprietà</a></li>
@stop

@include('estate::layouts.elements.title', ['title' => 'Associa Proprietà ad un cliente'])


@section('content')

    {!! Form::open(['url' => route('ownerships.store'), 'autocomplete' => 'off']) !!}
        <div class="row">
            @include('estate::components.errors')

            <div class="col-md-8 offset-md-2">
                <div class="card card-outline card-primary">
                    <div class="card-body">

                        @include('properties::ownerships.form')

                    </div>
                    <div class="card-footer p-0">
                        <button type="submit" class="btn btn-primary btn-sm btn-block btn-save-request"> <i class="fa fa-save"></i> Salva</button>
                    </div>
                </div>
            </div>

        </div>
    {!! Form::close() !!}

@stop
