<div class="row">

    <div class="col-xs-12 col-sm-3 pull-xs-left text-center text-sm-left">
        <div class="sort-input">
            <div class="form-group form-group-mod-1">
                <label for="sort-1" class="form-label">{{__('Ordina per')}}</label>
                <select id="sort-1" data-minimum-results-for-search="Infinity" class="form-control select-filter">
                    <option value="default" selected="selected">Default</option>
                    <option value="price=asc" >{{__('Prezzo Basso -> Alto')}}</option>
                    <option value="price=desc">{{__('Prezzo Alto -> Basso')}}</option>
                </select>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-2 mt-4 text-center">
        <h3><small><b>{{$properties->total()}} {{__('Immobili')}}</b></small></h3>
    </div>
    <div class="col-xs-12 col-lg-7 text-center text-right-lg mt-4 smallerPagination">
        {!! $properties->links() !!}
    </div>

</div>
