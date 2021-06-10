@extends('layouts.empty')

@section('content')

    <section class="section-md text-center">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h2>{{ __('Registrazione') }}</h2>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-lg-4 col-lg-offset-4">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
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

                                <input placeholder="almeno 8 caratteri" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                    <br>
                                <input placeholder="ripeti password" id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
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
                                        {{ __('Registrati') }}
                                    </button>
                                </div>
                                <div class="col-sm-6 text-center">
                                    <p style="font-size:110%;">
                                        <a class="" href="{{ route('login') }}">
                                            {{__('hai già un account?')}}<br>
                                            <b><u>{{__('Login!')}}</u></b>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
