<div class="rd-navbar-nav-wrap">
    <ul class="rd-navbar-nav">
        <li><a href="{{route('welcome')}}">Home</a></li>
        <li><a href="{{route(app()->getLocale().'.agenzia')}}">{{__("L'agenzia")}}</a></li>
        <li>
            <a href="{{route(app()->getLocale().'.vendita')}}">{{__('Vendita')}}</a>
        </li>
        <li>
            <a href="{{route(app()->getLocale().'.affitto')}}">{{__('Affitto')}}</a>
        </li>
        <li><a href="{{route(app()->getLocale().'.contatti')}}">{{__('Contatti')}}</a></li>

        <li class="rd-navbar-bottom-panel">
            <div class="rd-navbar-bottom-panel-wrap">
                <dl class="dl-horizontal-mod-1 login">
                    <dt>
                        <span class="mdi mdi-login icon-xxs-mod-2"></span>
                    </dt>
                    <dd>
                        @auth
                            <a href="{{route('account.client')}}" class="text-sushi"> {!! is_null(auth()->user()->contact) ? 'Utente' : auth()->user()->contact->nome !!}</a>
                        @endauth
                        @guest
                            <a href="{{route('login')}}" class="text-sushi">{{__('Area riservata')}}</a>
                        @endguest

                    </dd>
                </dl>
                <dl class="dl-horizontal-mod-1">
                    <dd>
                            @if(app()->getLocale() == 'it')
                                <a href="#" class="slangM" data-locale="en">
                                    <span><img src="{{asset('theme/en.svg')}}" style="width:20px;"/> English</span>
                                </a>
                            @endif

                            @if(app()->getLocale() == 'en')
                                <a href="#" class="slangM" data-locale="it">
                                    <span><img src="{{asset('theme/it.svg')}}" style="width:20px;"/> Italiano</span>
                                </a>
                            @endif


                        <form id="lang-form-m" action="{{ url('switch-locale') }}" method="POST" style="display: none;">
                            @csrf
                            <input name="locale" value="" id="sl-locale-m">
                            <input name="route" value="{{\Route::currentRouteName()}}" id="sl-locale-m">
                        </form>


                            <script>
                                let elementsM = document.getElementsByClassName("slangM");

                                let myFunctionM = function() {
                                    console.log(this);
                                    document.getElementById('sl-locale-m').value = this.getAttribute("data-locale");
                                    document.getElementById('lang-form-m').submit();
                                };

                                Array.from(elementsM).forEach(function(element) {
                                    element.addEventListener('click', myFunctionM);
                                });
                            </script>

                    </dd>
                </dl>
                <div class="top-panel-inner">
                    <dl class="dl-horizontal-mod-1">
                        <dt>
                            <span class="icon-xxs-mod-2 material-icons-local_phone"></span>
                        </dt>
                        <dd>
                            <a href="callto:00390436863886">+39 0436 863886</a>
                        </dd>
                    </dl>
                    <dl class="dl-horizontal-mod-1">
                        <dt>
                            <span class="material-icons-drafts icon-xxs-mod-2"></span>
                        </dt>
                        <dd>
                            <a href="mailto:agenzia@cortinese.it"> agenzia@cortinese.it</a>
                        </dd>
                    </dl>
                    <address>
                        <dl class="dl-horizontal-mod-1">
                            <dt>
                                <span class="icon-xxs-mod-2 mdi mdi-map-marker-radius"></span>
                            </dt>
                            <dd>
                                <a href="#" class="inset-11">Piazza S. Francesco 15 - 32043 Cortina d'Ampezzo (BL)</a>
                            </dd>
                        </dl>
                    </address>
                </div>
                <ul class="list-inline">
                    <li>
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                    </li>

                </ul>
            </div>
        </li>

    </ul>
</div>
