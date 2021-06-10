<section class="section-sm section-bottom-0 undefined text-left">
    <div class="container position-margin-top position-margin-top-mod-1">
        <div class="search-form-wrap bg-white container-shadow">
            <h3>{{__('Trova la tua casa')}}</h3>

            {!! Form::open(['url' => $url, 'method' => 'GET', 'name' => 'search-form', 'class' => 'form-variant-1', 'id'=>'search-Property']) !!}
                <div class="form-group">
                    <label for="select-search-1" class="form-label">{{__('Contratto')}}</label>
                    {!! Form::select('contract_id', $contracts, request('contract_id'), ['id' => 'select-search-0', 'data-minimum-results-for-search' => 'Infinity', 'class' => 'form-control select-filter ajaxCall'])!!}
                </div>
                <div class="form-group">
                    <label for="select-search-1" class="form-label">{{__('Città')}}</label>
                    {!! Form::select('city_id', [''=>__('Qualsiasi')]+\Areaseb\Estate\Models\Property::realCities(), request('city_id'), ['id' => 'select-search-1', 'data-minimum-results-for-search' => 'Infinity', 'class' => 'form-control select-filter ajaxCall']) !!}
                </div>
                <div class="form-group">
                    <label for="select-search-2" class="form-label">{{__('Tipologia')}}</label>
                    {!! Form::select('tag_id', [''=>__('Qualsiasi')]+\Areaseb\Estate\Models\Property::realTags(), request('tag_id'), ['id' => 'select-search-2', 'data-minimum-results-for-search' => 'Infinity', 'class' => 'form-control select-filter ajaxCall']) !!}
                </div>
                <div class="form-group">
                    <label for="select-search-3" class="form-label">{{__('Stato')}}</label>
                    {!! Form::select('state', [''=>__('Qualsiasi')]+\Areaseb\Estate\Models\Property::uniqueState(), request('state'), ['id' => 'select-search-3', 'data-minimum-results-for-search' => 'Infinity', 'class' => 'form-control select-filter ajaxCall']) !!}
                </div>
                @php
                    $arr = array_merge(range(5,12),range(14,30,2),range(35,50,5));
                    foreach ($arr as $value)
                    {
                        $prices[] = $value*10000;
                    }
                    $prices[] = 500001;
                @endphp
                <div class="form-group width-1">
                    <span>{{__('Prezzo')}} (€)<br></span>
                    <div class="form-inline-flex-xs">

                        <select name="min_price" class="form-control select-filter ajaxCall" data-minimum-results-for-search="Infinity">
                            <option value="">{{__('da')}}</option>
                            @foreach($prices as $price)
                                @if($price <= 500000)
                                    @if(request('min_price') == $price)
                                        <option selected="selected" value="{{$price}}">{{number_format($price, 0, ',', '.')}}</option>
                                    @else
                                        <option value="{{$price}}">{{number_format($price, 0, ',', '.')}}</option>
                                    @endif
                                @endif
                            @endforeach
                        </select>

                        <span class="text-abbey dash">—</span>
                        <select name="max_price" class="form-control select-filter ajaxCall" data-minimum-results-for-search="Infinity">
                            <option value="">{{__('a')}}</option>
                            @foreach($prices as $price)
                                @if($price > 500000)
                                    @if(request('max_price') == $price)
                                        <option selected="selected" value="{{$price}}">+500.000</option>
                                    @else
                                        <option value="{{$price}}">+500.000</option>
                                    @endif
                                @else
                                    @if(request('max_price') == $price)
                                        <option selected="selected" value="{{$price}}">{{number_format($price, 0, ',', '.')}}</option>
                                    @else
                                        <option value="{{$price}}">{{number_format($price, 0, ',', '.')}}</option>
                                    @endif
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group width-1">
                    <span>{{__('Superficie')}} (mq)
                        <br>
                    </span>
                    <div class="form-inline-flex-xs">
                        {!! Form::select('min_mq', [''=>__('da')]+array_combine(range(60,300,10), range(60,300,10)),request('min_mq'), ['class' => 'form-control select-filter ajaxCall', 'data-minimum-results-for-search' =>"Infinity"]) !!}
                        <span class="text-abbey dash">—</span>
                        {!! Form::select('max_mq', [''=>__('a')]+array_combine(range(70,400,10), range(70,400,10)),request('max_mq'), ['class' => 'form-control select-filter ajaxCall', 'data-minimum-results-for-search' =>"Infinity"]) !!}
                    </div>
                </div>
                <div class="form-group width-2">
                    <label for="select-search-7" class="form-label">Min {{__('Camere')}}</label>
                    {!! Form::select('n_bedrooms', [''=>__('Qualsiasi')]+array_combine(range(1,6), range(1,6))+['6+'=>'6+'],request('n_bedrooms'), ['class' => 'form-control select-filter ajaxCall', 'data-minimum-results-for-search' =>"Infinity",  'id'=>'select-search-7']) !!}
                </div>
                <div class="form-group width-2">
                    <label for="select-search-8" class="form-label">Min {{__('Bagni')}}</label>
                    {!! Form::select('n_bathrooms', [''=>__('Qualsiasi')]+array_combine(range(1,8), range(1,8))+['8+'=>'8+'],request('n_bathrooms'), ['class' => 'form-control select-filter ajaxCall', 'data-minimum-results-for-search' =>"Infinity", 'id'=>'select-search-8']) !!}
                </div>
                <button class="btn btn-sm btn-sushi btn-min-width-sm d-none">{{__('Cerca')}}</button>
                <div class="features">

                    @php
                        if(isset($contracts['']))
                        {
                            $availables = \Areaseb\Estate\Models\Feat::availables();
                            $reset = route(app()->getLocale().'.immobili');

                        }
                        elseif(isset($contracts[2]))
                        {
                            $availables = \Areaseb\Estate\Models\Feat::availablesRent();
                            $reset = route(app()->getLocale().'.affitto');
                        }
                        else
                        {
                            $availables = \Areaseb\Estate\Models\Feat::availablesSell();
                            $reset = route(app()->getLocale().'.vendita');
                        }
                    @endphp
                    @if(request('contract_id'))
                        <div class="pull-right"><a href="{{$reset}}" class="btn btn-sm btn-danger" style="margin-top:-10px;height:auto;margin-left:0;margin-right:12px;"><i class="fa fa-redo"></i> Reset Campi</a></div>
                    @endif
                    <a href="" onclick="return false" class="btn-features">
                        <span></span>{{__('Altre caratteristiche')}}</a>
                    <ul class="checkbox-list list-inline">


                        @foreach($availables as $feat)
                            <li>
                                <label class="checkbox-inline">
                                    <input name="feats[]" value="{{$feat->id}}" type="checkbox">
                                    <span>{{$feat->name}} ({{$feat->properties()->count()}})</span>
                                </label>
                            </li>
                        @endforeach
                    </ul>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</section>



@push('scripts')
    <script src="{{asset('plugins/axios/axios.min.js')}}"></script>
    <script>

        let form = $('#search-Property');

        form.on('submit', function(event){
            event.preventDefault();
            let data = {};
            data.url = 'http://localhost/real-estate/public/grid';
            data.form_data = $(this).serialize();
            console.log(data);
            axios.get(data.url+'?'+data.form_data).then(response => {
                console.log(response.data);
                $('section#property-content').html(response.data);
            });

        });

        $('select.ajaxCall').on('change', function(){
            form.submit();
        });

    </script>
@endpush
