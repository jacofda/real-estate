@extends('layouts.empty')

@section('content')

    <section class="section-md text-center">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h2>{{ __('Login') }}</h2>
                </div>
            </div>
            <hr>
            <div class="row" style="margin-top:10px;">
                <div class="col-xs-12">
                    <img src="{{asset('theme/images/logo.png')}}" style="max-width:220px; text-align:center;margin-left:auto;margin-right:auto;display:block;"/>
                </div>
            </div>
            <div class="row" style="margin-top:10px;">
                <div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-lg-4 col-lg-offset-4">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row mt-1">
                            <label for="email" class="form-label">{{ __('Email') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="password" class="form-label">{{ __('Password') }}</label>

                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group row mb-0 text-center">
                            <div class="row">
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                                <div class="col-sm-6 text-center">
                                    <p style="font-size:110%;"><a class="" href="{{ route('register') }}">
                                        {{__('non hai un account?')}}<br>
                                        <b><u>{{__('Registrati!')}}</u></b>
                                    </a></p>
                                </div>
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
