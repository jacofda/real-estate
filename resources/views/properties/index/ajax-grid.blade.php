@if($properties->total())
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
@else
    <div class="container">
        <div class="row">
            <div class="col-xs-12 pull-xs-left mt-3">
                <p style="font-size:130%;">{{__('Non ci sono risultati con questa ricerca')}}</p>
            </div>
        </div>
    </div>
@endif
