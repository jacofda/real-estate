<section class="section-md text-center text-sm-left bg-dark">
    <div class="container">
        <h2>{{__('Occasioni')}}</h2>
        <hr>
        @foreach (\Areaseb\Estate\Models\Property::whereNotNull('discounted')->get()->chunk(3) as $group)
            <div class="row clearleft-custom">
                @include('properties.index.grid')
            </div>
        @endforeach
    </div>
</section>
