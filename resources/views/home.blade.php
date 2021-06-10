@extends('layouts.app')

@section('content')
    <section class="text-left account-page" >
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h1>{{__('Account')}}</h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="{{route('welcome')}}">Home</a>
                        </li>
                        <li class="active">Account</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    @php
        $contact = auth()->user()->contact;
        $client = is_null($contact) ? null : $contact->client;
    @endphp

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
                <div class="col-lg-9 col-lg-offset-1"></div>
            </div>
        </div>
    </section>
@endsection
