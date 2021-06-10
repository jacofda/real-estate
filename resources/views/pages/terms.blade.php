@extends('layouts.app')

@section('meta')
    <title>{{__('Termini e condizioni')}}</title>
@stop

@section('content')
    <section class="section-full text-left">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h1>{{__('Termini e condizioni')}}</h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="{{route('welcome')}}">Home</a>
                        </li>
                        <li class="active">{{__('Termini e condizioni')}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
@stop
