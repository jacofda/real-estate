@extends('layouts.app')

@section('meta')
    <title>{{__('Sitemap')}}</title>
@stop

@section('content')
    <section class="section-full text-left">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h1>{{__('Sitemap')}}</h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="{{route('welcome')}}">Home</a>
                        </li>
                        <li class="active">{{__('Sitemap')}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
@stop
