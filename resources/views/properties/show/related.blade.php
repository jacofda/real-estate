@if(!$property->related->isEmpty())
    <section class="section-md bg-dark">
        <div class="container">
            <h2>{{__('Immobili Correlati')}}</h2>
            <hr>
            <div data-items="1" data-xs-items="2" data-sm-items="2" data-md-items="3" data-stage-padding="0" data-loop="false" data-margin="30" data-dots="true" data-autoplay="true" class="owl-carousel owl-carousel-mod-3">
                @foreach($property->related as $p)

                    <div class="owl-item">
                        <div class="team-member">
                            <div class="media media-mod-3">
                                <div class="media-left img-width-auto">
                                    <img src="{{$p->thumb}}" alt="{{$p->name}}" width="100" height="100">
                                </div>
                                <div class="media-body">
                                    <h5 class="text-sushi property-title correlated">{{$p->name}}</h5>
                                    <p>{{$p->contract->name}} - {{$p->tag->name}}</p>
                                    {{-- <dl class="dl-horizontal-mod-1 text-ubold text-abbey">
                                        <dt>tel.</dt>
                                        <dd>
                                            <a href="callto:#">1-800-1234-567</a>
                                        </dd>
                                    </dl> --}}
                                </div>
                            </div>
                            <p>{{$p->short_desc}}</p>
                            <a href="{{$p->url}}" class="btn btn-sm btn-primary">{{__('Vedi Dettagli')}}</a>
                        </div>
                    </div>

                @endforeach
            </div>
        </div>
    </section>
@endif
