<section class="section-md text-center text-sm-left">
    <div class="container">
        <h2>{{__('Ultimi Arrivi')}}</h2>
        <hr>
        @foreach (\Areaseb\Estate\Models\Property::whereNotNull('highlighted')->get()->chunk(3) as $group)
            <div class="row clearleft-custom">
                @include('properties.index.grid')
            </div>
        @endforeach
    </div>
</section>
