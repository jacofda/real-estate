<section class="section-md section-mod-1 text-left" id="property-content">
    <div class="container">

        @include('properties.index.sorter-top-pagination')

        @foreach ($properties->chunk(3) as $group)
            <div class="row">
                @include('properties.index.grid')
            </div>
        @endforeach

        <div class="row">
            <div class="col-xs-12 text-center">
                {!! $properties->links() !!}
            </div>
        </div>

    </div>
</section>

@include('layouts.elements.why-us')
@include('layouts.elements.warranties')
