<div class="rd-navbar-top-panel">
    <div class="rd-navbar-top-panel-wrap">
        <dl class="dl-horizontal-mod-1 login">
            @auth
                @if(auth()->user()->hasRole('super'))
                    <dt>
                        <span class="mdi mdi-login icon-xxs-mod-2"></span>
                    </dt>
                    <dd>
                        <a href="{{route('dashboard')}}" class="text-sushi">ADMIN</a>
                    </dd>
                @endif
            @endauth
        </dl>
        <div class="top-panel-inner">
            <dl class="dl-horizontal-mod-1">
                <dt>
                    <span class="material-icons-local_phone icon-xxs-mod-2"></span>
                </dt>
                <dd>
                    <a href="callto:+390436863886">0436 863886</a>
                </dd>
            </dl>
            <dl class="dl-horizontal-mod-1">
                <dt>
                    <span class="material-icons-drafts icon-xxs-mod-2"></span>
                </dt>
                <dd>
                    <a href="mailto:agenzia@cortinese.it">agenzia@cortinese.it</a>
                </dd>
            </dl>
            <address>
                <dl class="dl-horizontal-mod-1">
                    <dt>
                        <span class="mdi mdi-map-marker-radius icon-xxs-mod-2"></span>
                    </dt>
                    <dd>
                        <a href="#" class="inset-11">Piazza S. Francesco 15 - 32043 Cortina d'Ampezzo (BL) </a>
                    </dd>
                </dl>
            </address>
        </div>
        <ul class="list-inline">
            @include('layouts.elements.lang')
        </ul>
        {{-- <div class="btn-group">
            <a href="submit-property.html" class="btn btn-sm btn-primary">Submit Property</a>
        </div> --}}
    </div>
</div>
