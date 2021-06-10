@extends('layouts.app')

@section('meta')
    <title>{{__('Le mie credenziali')}}</title>
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

                        <li class="active">{{__('Credenziali')}}</li>
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

                    <h2>{{__('Cambia email o password')}}</h2>
                    <hr><br><br>
                    {!! Form::open(['url' => url('account/credentials')]) !!}
                        <div class="form-group">
                            <label for="email" class="form-label">{{__('Email')}}</label>
                            <input id="email" type="text" name="email" placeholder="{{__('la tua email')}}" class="form-control" value="{{old('email') ?? auth()->user()->email}}">
                        </div>

                        <div class="form-group">
                            <label for="password" class="form-label">{{__('Password')}}</label>
                            <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation" class="form-label">{{__('Conferma password')}}</label>
                            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-sm btn-sushi btn-min-width-sm">{{__('Aggiorna')}}</button>
                        </div>
                    {!! Form::close() !!}
                </div>

        </div>
    </div>
</section>
@endsection
