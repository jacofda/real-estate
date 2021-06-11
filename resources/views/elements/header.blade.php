<header class="page-head rd-navbar-wrap header_corporate">
    <nav class="rd-navbar" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fullwidth" data-md-layout="rd-navbar-fullwidth" data-lg-layout="rd-navbar-fullwidth" data-device-layout="rd-navbar-fixed" data-sm-device-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-lg-device-layout="rd-navbar-fullwidth" data-stick-up-offset="100px">
        @include('elements.top-nav')
        <div class="rd-navbar-inner inner-wrap">
            <div class="rd-navbar-panel">
                <button data-rd-navbar-toggle=".rd-navbar-nav-wrap" class="rd-navbar-toggle">
                    <span></span>
                </button>
                <div class="rd-navbar-brand">
                    <a href="{{route('welcome')}}" class="brand-name">
                        <img src="{{asset('theme/images/Logo-Cortinese-250x80.png')}}" alt="{{config('app.name')}}">
                    </a>
                </div>
            </div>
            <div class="btn-group">
                @guest
                    <a href="{{route('login')}}" class="btn btn-sm btn-primary f13" title="{{__('Login o registrati')}}"><i class="fa fa-sign-in-alt"></i> {{__('Area riservata')}}</a>
                @endguest
                @auth
                    <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                         <i class="far fa-user"></i> {!! is_null(auth()->user()->contact) ? 'Utente' : auth()->user()->contact->nome !!}
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{route('account.credentials')}}" title="{{__('Credenziali')}}"> {{__('Credenziali')}}</a>
                        </li>
                        <li>
                            <a href="{{route('account.client')}}" title="{{__('Dati Anagrafici')}}"> {{__('Dati anagrafici')}}</a>
                        </li>
                        <li>
                            <a href="{{route('account.properties')}}" title="{{__('I miei immobili')}}"> {{__('I miei immobili')}}</a>
                        </li>

                        <li>
                            <a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="" title="{{__('Logout')}}"><i class="fas fa-sign-out-alt"></i> {{__('Logout')}}</a>
                            <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>

                @endauth
            </div>

            @include('layouts.elements.menu')
        </div>
      </nav>
    </header>
