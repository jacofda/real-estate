<section>
    <div data-height="" data-min-height="600px" class="swiper-container swiper-slider">
        <div class="swiper-wrapper">
            @foreach(\Areaseb\Estate\Models\Property::whereNotNull('slide')->orderBy('slide', 'ASC')->get() as $slide)
                <div data-slide-bg="{{$slide->original}}" class="swiper-slide">
                    <div class="swiper-slide-caption">
                        <div class="container">
                            <div data-caption-animate="fadeInDown" class="swiper-caption-wrap">
                                <p data-caption-animate="fadeIn" data-caption-delay="800" class="h3">{{ucwords(strtolower($slide->name))}}</p>
                                <hr data-caption-animate="fadeIn" data-caption-delay="800">
                                <p data-caption-animate="fadeIn" data-caption-delay="800" class="hidden-xs">{{$slide->short_desc}}</p>
                                <div data-caption-animate="fadeIn" data-caption-delay="800" class="price text-ubold">
                                    @if($slide->contract_id == 1 || $slide->contract_id == 3)
                                        @if($slide->sell_price)
                                            € {{$slide->prezzo_vendita}}
                                        @else
                                            {{__('Trattativa riservata')}}
                                        @endif
                                    @else
                                        @if($slide->rent_price)
                                            € {{$slide->rent_price}}
                                            <span>/{{__($slide->rent_period)}}</span>
                                        @else
                                            {{__('Trattativa riservata')}}
                                        @endif
                                    @endif
                                </div>

                                <a href="{{$slide->url}}" data-caption-animate="fadeIn" data-caption-delay="800" class="btn btn-sm btn-sushi">{{__('Vedi dettagli')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
        </div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>
</section>
