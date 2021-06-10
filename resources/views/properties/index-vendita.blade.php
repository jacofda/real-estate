@extends('layouts.app')

@section('meta')
<title> {{__('Immobili in Vendita')}}</title>
@stop

@section('title')
    <section class="section-full section-full-mod-1 text-left">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h1>{{__('Immobili in Vendita')}}</h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="{{route('welcome')}}">Home</a>
                        </li>
                        <li class="active">{{__('Immobili in Vendita')}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
@stop

@section('search')
    @include('properties.index.search', ['url' => route(app()->getLocale().'.vendita'), 'contracts' => [1=>__('Vendita')]])
@stop

@section('content')

    @include('properties.index.wrapper')

@stop
