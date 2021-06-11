@extends('layouts.app')

@section('meta')
    <title>{{__('Iscriviti alla newsletter')}}</title>
@stop

@section('content')
    <section class="section-full text-left">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h1>{{__('Iscriviti alla newsletter')}}</h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="{{route('welcome')}}">Home</a>
                        </li>
                        <li class="active">{{__('Iscriviti alla newsletter')}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="section-md text-left about">
        <div class="container">
            <h2>{{__('Compila il modulo')}}</h2>
            <h5 class="mt-0 text-upper color-lighter">{{__('Inserisci le tue preferenze per ricevere email personalizzate')}}</h5>
            <hr>
            <div class="row submit-form text-left">

                @php
                    $contact = null;
                    $client = null;
                    if(auth()->user())
                    {
                        $contact = auth()->user()->contact;
                        $client = is_null($contact) ? null : $contact->client;
                    }

                @endphp


                {!! Form::open(['url' => route('account.client.update')]) !!}
                <div class="row submit-form text-left">
                    <div class="col-sm-6">

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="nome" class="form-label">{{__('Nome')}}</label>
                                    <input id="nome" type="text" name="nome" class="form-control" value="{{$contact ? $contact->nome : old('nome')}}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="cognome" class="form-label">{{__('Cognome')}}</label>
                                    <input id="cognome" type="text" name="cognome" class="form-control" value="{{$contact ? $contact->cognome : old('cognome') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="email" class="form-label">{{__('Email')}}</label>
                                    <input id="email" type="text" name="email"  class="form-control" value="{{$client ? $client->phone : old('phone') }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="cellulare" class="form-label">{{__('Telefono')}}</label>
                                    <input id="cellulare" type="text" name="cellulare"  class="form-control" value="{{$contact ? $contact->cellulare : old('cellulare')}}">
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-sm-6">


                    </div>
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-sm btn-sushi btn-min-width-sm">{{__('Salva')}}</button>
                    </div>
                    {!!Form::close()!!}


        </div>
    </section>

@stop
