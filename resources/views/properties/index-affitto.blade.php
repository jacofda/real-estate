@extends('layouts.app')

@section('meta')
<title> {{__('Immobili in Affitto')}}</title>
@stop

@section('title')
    <section class="section-full section-full-mod-1 text-left">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h1>{{__('Immobili in Affitto')}}</h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="{{route('welcome')}}">Home</a>
                        </li>
                        <li class="active">{{__('Immobili in Affitto')}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
@stop

@section('search')
    @include('properties.index.search', ['url' => route(app()->getLocale().'.affitto'), 'contracts' => [2 => __('Affitto')]])
@stop

@section('content')

    @include('properties.index.wrapper')

@stop
