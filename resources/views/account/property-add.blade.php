{{-- <h2>Fill in the Form</h2> --}}
<h2 class="mb-0">{{__('Compila la Form')}}</h2>
<h4><small>{{__('La vostra richiesta verrà pubblicato solo dopo l\'approvazione degli amministratori')}}</small></h4>
<hr>
{!! Form::open(['url'=>route('account.properties.store')]) !!}
{!!Form::hidden('user_id', auth()->user()->id) !!}
<div class="row submit-form text-left">


    <div class="col-sm-6">

            <div class="form-group @if($errors->has('name_it')) is-invalid @endif">
                <label for="name_it" class="form-label">{{__('Titolo Immobile')}}*</label>
                <input id="name_it" type="text" name="name_it" placeholder="{{__('Casa dei sogni ...')}}" class="form-control" required value="{{old('name_it')}}">
                @error('name_it') <small>{{$message}}</small> @enderror
            </div>
            <div class="form-group @if($errors->has('desc_it')) is-invalid @endif">
                <label for="desc_it" class="form-label">{{__('Descrizione Immobile')}}*</label>
                <textarea id="desc_it" name="desc_it" placeholder="{{__('Descrizione accurata ...')}}" class="form-control min-height" required >{{old('desc_it')}}</textarea>
                @error('desc_it') <small>{{$message}}</small> @enderror
            </div>
            <div class="row">

                <div class="col-sm-6">
                    <div class="form-group @if($errors->has('tag_id')) is-invalid @endif">
                        <label for="select-2" class="form-label">{{__('Tipologia')}}*</label>
                        {!! Form::select('tag_id', [''=>__('Qualsiasi')]+\Areaseb\Estate\Models\Property::realTags(), old('tag_id'), ['id' => 'select-search-2', 'data-minimum-results-for-search' => 'Infinity', 'class' => 'form-control select-filter']) !!}
                        @error('tag_id') <small>{{$message}}</small> @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group @if($errors->has('city_id')) is-invalid @endif">
                        <label for="select-3" class="form-label">{{__('Città')}}*</label>
                        {!! Form::select('city_id', [''=>__('Qualsiasi')]+\Areaseb\Estate\Models\Property::realCities(), old('city_id'), ['id' => 'select-search-1', 'data-minimum-results-for-search' => 'Infinity', 'class' => 'form-control select-filter']) !!}
                        @error('city_id') <small>{{$message}}</small> @enderror
                    </div>
                </div>

            </div>

    </div>
    <div class="col-xs-12 col-sm-6">
        <div class="row">


            <div class="col-sm-6">
                <div class="form-group">
                    <label for="select-3" class="form-label">{{__('Contratto')}}</label>
                    {!! Form::select('contract_id',[1=>__('Vendita'), 2=>__('Affitto')], old('contract_id'), ['id' => 'select-search-0', 'data-minimum-results-for-search' => 'Infinity', 'class' => 'form-control select-filter']) !!}
                </div>
            </div>

            <div class="col-sm-6 box-vendita">
                <div class="form-group @if($errors->has('sell_price')) is-invalid @endif">
                    <label for="sell_price" class="form-label">{{__('Prezzo Vendita')}}</label>
                    <input id="sell_price" type="number" name="sell_price" placeholder="" class="form-control" value="{{old('sell_price')}}">
                    @error('sell_price') <small>{{$message}}</small> @enderror
                </div>
            </div>

            <div class="col-sm-6 d-none box-affitto">
                <div class="form-group">
                    <label for="rent_price" class="form-label">{{__('Prezzo Affitto')}}</label>
                    <input id="rent_price" type="number" name="rent_price" placeholder="" class="form-control" value="{{old('rent_price')}}">

                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label for="ssurface" class="form-label">{{__('Superficie')}}</label>
                    <input id="ssurface" type="text" name="surface" placeholder="" class="form-control">
                </div>
            </div>


            <div class="col-sm-6">
                <div class="form-group">
                    <label for="select-4" class="form-label">{{__('Camere')}}</label>
                    {!! Form::select('n_bedrooms', array_combine(range(0,6), range(0,6)),request('n_bedrooms'), ['class' => 'form-control select-filter', 'data-minimum-results-for-search' =>"Infinity",  'id'=>'select-search-7']) !!}

                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="select-5" class="form-label">{{__('Bagni')}}</label>
                    {!! Form::select('n_bathrooms', array_combine(range(0,8), range(0,8)),request('n_bathrooms'), ['class' => 'form-control select-filter', 'data-minimum-results-for-search' =>"Infinity", 'id'=>'select-search-8']) !!}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="select-6" class="form-label">{{__('Classe Energetica')}}</label>
                    {!! Form::select('energy_class', config('properties.energy_class'), null, ['data-minimum-results-for-search'=>"Infinity"]) !!}
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label for="select-1" class="form-label">{{__('Stato')}}</label>
                    {!! Form::select('state', [''=>__('Qualsiasi')]+\Areaseb\Estate\Models\Property::uniqueState(), old('state'), ['id' => 'select-search-3', 'data-minimum-results-for-search' => 'Infinity', 'class' => 'form-control select-filter']) !!}
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label for="select-99" class="form-label" style="color:transparent">A</label>
                    <button type="submit" class="btn btn-sm btn-sushi btn-min-width-sm">{{__('Invia')}}</button>
                </div>
            </div>

        </div>
    </div>

</div>
{!! Form::close() !!}

@push('scripts')
    <script>

    $('.is-invalid input').on('keyup', function(){
        $(this).parent('div').removeClass('is-invalid');
        $(this).siblings('small').remove();
    });

    $('.is-invalid select').on('change', function(){
        $(this).parent('div').removeClass('is-invalid');
        $(this).siblings('small').remove();
    });


        $('select[name="contract_id"]').on('change', function(){
            if(parseInt($(this).val()) === 1)
            {
                $('.box-vendita').removeClass('d-none');
                $('.box-affitto').addClass('d-none');
            }
            else
            {
                $('.box-affitto').removeClass('d-none');
                $('.box-vendita').addClass('d-none');
            }
        });
    </script>
@endpush
