<footer class="page-foot text-left">
    <section class="footer-content">
        <div class="container">
            <div class="row flow-offset-3">
                <div class="col-xs-12 col-sm-6 col-lg-3">
                    <div class="rd-navbar-brand">
                        <a href="{{route('welcome')}}" class="brand-name">
                            <img src="{{asset('theme/images/Logo-Cortinese-250x80.png')}}" alt="{{config('app.name')}}" class="mb-2">
                        </a>
                    </div>
                    {{-- <p>We believe in Simple, Creative &amp; Flexible Design Standards.</p> --}}
                    <h6 class="text-ubold mb-0">{{__('Sede Cortina')}}</h6>
                    <address class="address mt-0" style="margin-top:0;">
                        <dl class="dl-horizontal-mod-1">
                            <b>{{__('Indirizzo')}}</b>:
                            <a target="_BLANK" href="https://goo.gl/maps/6vSsqwD7WAvn6Stw9" class="text-primary">Piazza S. Francesco 15 - 32043 Cortina d'Ampezzo (BL)</a>
                        </dl>
                        <dl class="dl-horizontal-mod-1">
                            <b>{{__('Telefono')}}:</b>
                            <dd>
                                <a href="callto:00390436863886" class="text-primary">+ 39 0436 863886</a>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal-mod-1">
                            <b>Email:</b>
                            <dd>
                                <a href="mailto:agenzia@cortinese.it" class="text-primary">agenzia
                                @cortinese.it</a>
                            </dd>
                        </dl>
                    </address>

                    <h6 class="text-ubold mb-0 mt-1">{{__('Sede San Vito')}}</h6>
                    <address class="address mt-0" style="margin-top:0;">
                        <dl class="dl-horizontal-mod-1">
                            <b>{{__('Indirizzo')}}</b>:
                            <a target="_BLANK" href="https://goo.gl/maps/vg7zSgM1MYb3ZVgm8" class="text-primary" >Corso Italia 8 - 32046 San Vito di Cadore (BL)</a>
                        </dl>
                        <dl class="dl-horizontal-mod-1">
                            <b>{{__('Telefono')}}:</b>
                            <dd>
                                <a href="callto:0039043699020" class="text-primary">+ 39 0436 99020</a>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal-mod-1">
                            <b>Email:</b>
                            <dd>
                                <a href="mailto:agsanvito@cortinese.it" class="text-primary">agsanvito
                                @cortinese.it</a>
                            </dd>
                        </dl>
                    </address>

                </div>
                <div class="col-xs-12 col-sm-6 col-lg-3">
                    <h6 class="text-ubold">{{__('Link Utili')}}</h6>
                    <ul class="list-marked well6 text-left text-primary">
                        <li>
                            <i class="fas fa-chevron-right footerI"></i><a href="{{route(app()->getLocale().'.vendita')}}">{{__('Vendita')}}</a>
                        </li>
                        <li>
                            <i class="fas fa-chevron-right footerI"></i><a href="{{route(app()->getLocale().'.affitto')}}">{{__('Affitto')}}</a>
                        </li>
                        @auth
                            <li>
                                <i class="fas fa-chevron-right footerI"></i><a href="{{route('home')}}">{{__('Account')}}</a>
                            </li>
                        @endauth
                        @guest
                            <li>
                                <i class="fas fa-chevron-right footerI"></i><a href="{{route('register')}}">{{__('Crea un account')}}</a>
                            </li>
                        @endguest
                        <li>
                            <i class="fas fa-chevron-right footerI"></i><a href="{{route(app()->getLocale().'.contatti')}}">{{__('Contatti')}}</a>
                        </li>
                        <li>
                            <i class="fas fa-chevron-right footerI"></i><a href="{{route(app()->getLocale().'.sitemap')}}">{{__('Sitemap')}}</a>
                        </li>
                        <li>
                            <i class="fas fa-chevron-right footerI"></i><a href="{{route('privacy')}}">{{__('Privacy Policy')}}</a>
                        </li>
                        <li>
                            <i class="fas fa-chevron-right footerI"></i><a href="{{route(app()->getLocale().'.terms')}}">{{__('Termini e Condizioni')}}</a>
                        </li>

                    </ul>
                </div>
                <div class="col-xs-12 col-sm-6 col-lg-3">
                    <h6 class="text-ubold">{{__('Categorie')}}</h6>
                    <ul class="list-marked well6 text-left">
                        @foreach(\Areaseb\Estate\Models\Tag::all() as $tag)
                            <li><i class="fas fa-chevron-right footerI"></i><a href="{{route(app()->getLocale().'.immobili')}}?tag_id={{$tag->id}}">{{$tag->name}}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-xs-12 col-sm-6 col-lg-3">
                    <h6 class="text-ubold">Newsletter</h6>
                    <p class="text-gray">
                        {{__('Iscriviti per ricevere le news, gli aggiornamenti, offerte speciali e altre informazioni.')}}
                    </p>
                    {!! Form::open(['url' => route(app()->getLocale().'.iscrizione'), 'method' => 'GET', 'class' => 'text-left subscribe']) !!}
                        <div class="form-group">
                            <label for="email-sub" class="form-label"></label>
                            <input id="email-sub" type="email" name="email" required placeholder="Email" class="form-control">
                        </div>
                        <button class="btn btn-sushi btn-sm">{{__('Iscriviti')}}</button>
                    {!! Form::close() !!}
                    <div class="cert mt-2">
                        <h6 class="text-ubold mb-2">{{__('Certificazioni')}}</h6>
                        <a target="_BLANK" href="https://www.anammi.it/">
                            <img style="width:68px" src="{{asset('theme/images/anammi.png')}}" alt="anammi"/>
                        </a>
                        <a target="_BLANK" href="http://www.fiaip.it/">
                            <img style="width:178px" src="{{asset('theme/images/fiaip.jpg')}}" alt="fiaip"/>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <section class="copyright">
        <div class="container">
            <p class="pull-sm-left">©
                <span id="copyright-year"></span> {{__('Tutti i diritti riservati')}} | P.IVA IT00655870251
            </p>
            <ul class="list-inline pull-sm-right">
                <li>
                    {{__('Seguici su')}} <a href="#"><i class="fab fa-facebook"></i></a>
                </li>
            </ul>
        </div>
    </section>
</footer>
