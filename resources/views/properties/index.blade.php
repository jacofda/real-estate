@extends('layouts.app')

@section('meta')
<title> {{__('Tutti gli immobili')}}</title>
@stop

@section('title')
    <section class="section-full section-full-mod-1 text-left">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h1>{{__('Tutti gli immobili')}}</h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="{{route('welcome')}}">Home</a>
                        </li>
                        <li class="active">{{__('Tutti gli immobili')}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
@stop

@section('search')
    @include('properties.index.search', ['url' => route(app()->getLocale().'.immobili'), 'contracts' => [''=>__('Qualsiasi'), 1=>__('Vendita'), 0 => __('Affitto')]])
@stop

@section('content')

    @include('properties.index.wrapper')



@stop
