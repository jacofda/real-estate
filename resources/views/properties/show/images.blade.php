<div data-arrows="true" data-loop="false" data-dots="false" data-swipe="true" data-xs-items="1" data-photo-swipe-gallery="gallery" data-child="#child-carousel" data-for=".thumbnail-carousel" class="slick-slider carousel-parent">
    @foreach($images as $img)
        <a data-photo-swipe-item="" data-size="{{$img->width}}x{{$img->height}}" href="{{$img->full}}" class="item">
            <img src="{{$img->page}}" alt="" width="770" height="513">
        </a>
    @endforeach
</div>

@if($images->count() > 1)
    <div id="child-carousel" data-for=".carousel-parent" data-arrows="true" data-loop="false" data-dots="false" data-swipe="true" data-items="2" data-xs-items="4" data-sm-items="4" data-md-items="5" data-lg-items="5" data-slide-to-scroll="1"
        class="slick-slider thumbnail-carousel">
        @foreach($images as $img)
            <div class="item">
                <div class="product-thumbnail">
                    <img src="{{$img->thumb}}" alt="" width="70" height="70">
                </div>
            </div>
        @endforeach
    </div>
@endif
{{-- <img src="http://localhost/real-estate/public/storage/properties/full/HpGJR-dsc02169.jpg" alt="" width="533" height="800"> --}}
