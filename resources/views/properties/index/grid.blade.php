@foreach($group as $property)

<div class="col-sm-12 col-md-4">

    <div class="thumbnail thumbnail-3">
        <a href="{{$property->url}}" class="img-link">
            <img src="{{$property->display}}" alt="{{$property->name}}">
        </a>
        <div class="caption">
            <h4 class="property-title">
                <a href="{{$property->url}}" class="text-sushi">{{$property->name}}</a>
            </h4>

            @if($property->sell_price)
                <span class="thumbnail-price h5">€ {{$property->prezzo_vendita}}</span>
            @else
                <span class="thumbnail-price h5"><small>{{__('trattativa privata')}}</small></span>
            @endif


            <ul class="describe-1" style="height:60px;">
                @php $c1=0; @endphp

                @if($property->surface)
                    @include('properties.attributes.surface')
                    @php $c1++; @endphp
                @endif
                @if($property->n_bathrooms)
                    @include('properties.attributes.n_bathrooms')
                    @php $c1++; @endphp
                @endif
                @if($property->n_floors)
                    @include('properties.attributes.n_floors')
                    @php $c1++; @endphp
                @endif
                @if($property->energy_class)
                    @include('properties.attributes.energy_class')
                    @php $c1++; @endphp
                @endif
                @if($property->heating)
                    @include('properties.attributes.heating')
                    @php $c1++; @endphp
                @endif

            </ul>
            <ul class="describe-2" style="height:60px;">

                @php $c2=0; @endphp

                @if($property->n_bedrooms)
                    @include('properties.attributes.n_bedrooms')
                    @php $c2++; @endphp
                @endif
                @if($property->n_garages)
                    @include('properties.attributes.n_garages')
                    @php $c2++; @endphp
                @endif

                @if($property->city_id)
                    @include('properties.attributes.city_id')
                    @php $c2++; @endphp
                @endif

                @if($property->tag_id)
                    @include('properties.attributes.tag_id')
                    @php $c2++; @endphp
                @endif
            </ul>
            <p class="text-abbey property-shortDesc">{{$property->short_desc}}</p>
        </div>
    </div>

</div>

@endforeach
