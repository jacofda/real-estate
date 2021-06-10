@extends('layouts.app')

@section('meta')
    <title>{{__('I miei immobili')}}</title>
@stop

@section('content')
    <section class="text-left account-page" >
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h1>{{__('I miei immobili')}}</h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="{{route('welcome')}}">Home</a>
                        </li>
                        <li>
                            <a href="{{route('home')}}">Account</a>
                        </li>

                        <li class="active">{{__('I miei immobili')}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="section-md text-left">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 mb-4">

                    <div class="btn-group-vertical" role="group" aria-label="..." style="width:100%">
                        <a href="{{route('account.credentials')}}" class="btn btn-primary-transparent btn-sm" style="width:100%; border-bottom:none;">{{__('Credenziali')}}</a>
                        <a href="{{route('account.client')}}" class="btn btn-primary-transparent btn-sm" style="width:100%; border-bottom:none;">{{__('Dati anagrafici')}}</a>
                        <a href="{{route('account.properties')}}" class="btn btn-primary-transparent btn-sm" style="width:100%;">{{__('I miei immobili')}}</a>
                    </div>

                </div>
                <div class="col-lg-9 col-lg-offset-1">

                    @if(auth()->user()->properties()->exists())
                        <div class="row">
                            @foreach (auth()->user()->properties as $property)
                                @include('account.property')
                            @endforeach
                        </div>
                        <br><br><hr><br><br><br><br>
                    @endif
                    @include('account.property-add')
                </div>
            </div>
        </div>
    </section>
@stop
