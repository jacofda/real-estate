@extends('estate::layouts.app')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{route('properties.index')}}">Proprietà</a></li>
@stop

@include('estate::layouts.elements.title', ['title' => 'Modifica associazione proprietà cliente'])


@section('content')

    {!! Form::model($ownership, ['url' => route('ownerships.update', $ownership->id), 'method' => 'patch']) !!}
        <div class="row">
            @include('estate::components.errors')

            <div class="col-md-8 offset-md-2">
                <div class="card card-outline card-primary">
                    <div class="card-body">

                        @include('estate::estate.ownerships.form')

                    </div>
                    <div class="card-footer p-0">
                        <button type="submit" class="btn btn-primary btn-sm btn-block btn-save-ownership"> <i class="fa fa-save"></i> Salva</button>
                    </div>
                </div>
            </div>

        </div>
    {!! Form::close() !!}

@stop
