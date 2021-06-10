@extends('layouts.app')

@section('meta')
    <title>{{__('I miei dati anagrafici')}}</title>
@stop

@section('content')
    <section class="text-left account-page" >
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h1>{{__('I tuoi dati')}}</h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="{{route('welcome')}}">Home</a>
                        </li>
                        <li>
                            <a href="{{route('home')}}">Account</a>
                        </li>

                        <li class="active">{{__('I tuoi dati')}}</li>
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
                <div class="col-lg-9 col-lg-offset-1">

                    <h2>{{__('Controlla o compila i tuoi dati')}}</h2>
                    <hr>
                    {!! Form::open(['url' => route('account.client.update')]) !!}
                    <div class="row submit-form text-left">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="nome" class="form-label">{{__('Nome')}}</label>
                                <input id="nome" type="text" name="nome" placeholder="Carlo" class="form-control" value="{{$contact ? $contact->nome : old('nome')}}">
                            </div>
                            <div class="form-group">
                                <label for="cognome" class="form-label">{{__('Cognome')}}</label>
                                <input id="cognome" type="text" name="cognome" placeholder="Rossi" class="form-control" value="{{$contact ? $contact->cognome : old('cognome') }}">
                            </div>

                            <div class="form-group">
                                <label for="telefono" class="form-label">{{__('Telefono')}}</label>
                                <input id="telefono" type="text" name="telefono" placeholder="Rossi" class="form-control" value="{{$client ? $client->phone : old('phone') }}">
                            </div>

                            <div class="form-group">
                                <label for="cellulare" class="form-label">{{__('Cellulare')}}</label>
                                <input id="cellulare" type="text" name="cellulare" placeholder="Rossi" class="form-control" value="{{$contact ? $contact->cellulare : old('cellulare')}}">
                            </div>
                        </div>

                        <div class="col-sm-6">


                            <div class="form-group">
                                <label for="address" class="form-label">{{__('Indirizzo')}}</label>
                                <input id="address" type="text" name="address" placeholder="Rossi" class="form-control" value="{{$client ? $client->address : old('address')}}">
                            </div>
                            <div class="row">
                                <div class="col-xs-8">
                                    <div class="form-group">
                                        <label for="city" class="form-label">{{__('Città')}}</label>
                                        <input id="city" type="text" name="city" placeholder="Rossi" class="form-control" value="{{$client ? $client->city : old('city')}}">
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label for="zip" class="form-label">{{__('CAP')}}</label>
                                        <input id="zip" type="text" name="zip" placeholder="Rossi" class="form-control" value="{{$client ? $client->zip : old('zip')}}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-8">
                                    <div class="form-group">
                                        <label for="province" class="form-label">{{__('Provincia')}}</label>
                                        <input id="province" type="text" name="province" placeholder="Rossi" class="form-control" value="{{$client ? $client->province : old('province')}}">
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label for="nation" class="form-label">{{__('Nazione')}}</label>
                                        <input id="nation" type="text" name="nation" placeholder="Rossi" class="form-control" value="{{$client ? $client->nation : old('nation')}}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-4">
                                    <label for="select-1" class="form-label">Privato</label>
                                    <select id="select-1" data-minimum-results-for-search="Infinity" class="form-control select-filter">
                                        <option value="1" selected="selected">Sì</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>

                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label for="cf" class="form-label">{{__('Codice Fiscale')}}</label>
                                        <input id="cf" type="text" name="cf" placeholder="Rossi" class="form-control" value="{{$client ? $client->cf : old('cf')}}">
                                    </div>
                                </div>

                                <div class="col-sm-8 piva d-none" >
                                    <div class="form-group">
                                        <label for="piva" class="form-label">{{__('P.IVA')}}</label>
                                        <input id="piva" type="text" name="piva" placeholder="Rossi" class="form-control" value="{{$client ? $client->piva : old('piva')}}">
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-sm btn-sushi btn-min-width-sm">{{__('Salva')}}</button>
                        </div>
                        {!!Form::close()!!}

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
