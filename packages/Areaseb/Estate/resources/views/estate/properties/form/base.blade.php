{!! Form::hidden('url_before', url()->previous()) !!}

<div class="col-md-6">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Caratteristiche Base</h3>
        </div>
        <div class="card-body">


            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Contratto*</label>
                        {!! Form::select('contract_id', $contracts, null) !!}
                        @include('estate::components.add-invalid', ['element' => 'contract_id'])
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Tipo</label>

                        @php
                            if(isset($property))
                            {
                                $type = $property->type;
                            }
                            else
                            {
                                $type = 1;
                            }
                        @endphp

                        {!! Form::select('type_id', $types, $type) !!}
                        @include('estate::components.add-invalid', ['element' => 'type_id'])
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Tipologia*</label>
                        {!! Form::select('tag_id', $tags, null) !!}
                        @include('estate::components.add-invalid', ['element' => 'tag_id'])
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Rif</label>
                        {!! Form::text('rif', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="col-sm-10">
                    <div class="form-group">
                        <label>Nome*</label>
                        {!! Form::text('name_it', null, ['class' => 'form-control', 'required']) !!}
                    </div>
                </div>
            </div>

            @isset($property)
                <div class="form-group">
                    <label>Slug IT</label>
                    {!! Form::text('slug_it', null, ['class' => 'form-control']) !!}
                </div>
            @endisset

            <div class="form-group">
                <label>Descrizione Corta*</label>
                {!! Form::text('short_desc_it', null, ['class' => 'form-control', 'required']) !!}
            </div>

            <div class="form-group">
                <label>Descrizione*</label>
                {!! Form::textarea('desc_it', null, ['class' => 'form-control', 'required']) !!}
            </div>

            <div class="form-group">
                <label>Indirizzo</label>
                <div class="input-group">
                    {!! Form::text('address', null, ['class' => 'form-control']) !!}
                    <div class="input-group-append d-none">
                        <a title="ottieni posizione accurata" href="" class="btn btn-primary"><i class="fa fa-marker"></i></a>
                    </div>
                </div>
            </div>

            <div class="row d-none" id="coordinates">
                <div class="col">
                    <div class="form-group">
                        {!! Form::text('lat', null, ['class' => 'form-control', 'placeholder' => 'Lat']) !!}
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        {!! Form::text('lng', null, ['class' => 'form-control', 'placeholder' => 'Lng']) !!}
                    </div>
                </div>
            </div>



            @php
                $province = null; $cities = []; $city = null;
                if(isset($property))
                {
                    $city = $property->city_id;
                    if($city)
                    {
                        $province = $property->city->provincia;
                        $cities = \Areaseb\Estate\Models\City::where('provincia', $property->city->provincia )->pluck('comune', 'id')->toArray();
                        if($city)
                        {
                            $areas = [''=>'']+\Areaseb\Estate\Models\Area::where('city_id', $city)->pluck('name', 'id')->toArray();
                        }
                    }
                }
            @endphp

            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Provincia*</label>
                        {!! Form::select('province', $provincies, $province) !!}
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="form-group">
                        <label>Comune*</label>
                        {!! Form::select('city_id', $cities, $city) !!}
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Area</label>
                        {!! Form::select('area_id', $areas, null) !!}
                    </div>
                </div>

            </div>




        </div>
    </div>
    @include('estate::estate.properties.form.trans')
    @include('estate::estate.properties.form.registry')
    @include('estate::estate.properties.form.pois')
</div>


@push('scripts')

    <script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
    <script src="{{asset('plugins/summernote/lang/summernote-it-IT.js')}}"></script>
    <script>

        $('input[name="address"]').on('keyup', function(){
            if($(this).val() != '')
            {
                $(this).siblings('div.input-group-append').removeClass('d-none');
                $('#coordinates').removeClass('d-none');
            }
            else
            {
                $(this).siblings('div.input-group-append').addClass('d-none');
                $('#coordinates').addClass('d-none');
            }
        });

        $('textarea[name="desc_it"]').summernote();
        $('select[name="province"]').select2({placeholder: 'Seleziona la provincia', width:'100%'});
        $('select[name="province"]').on('change', function(){
            $('select[name="city_id"]').empty().select2()
            let data = {};
            data._tonken = token;
            axios.post(baseURL+'api/cities/'+$(this).val()+'/province', data).then((response) => {
                $('select[name="city_id"]').select2({placeholder: 'Seleziona il comune', data:response.data, width:'100%'});
            });
        });

        $('select[name="city_id"]').on('change', function(){
            $('select[name="area_id"]').empty().select2()
            let data = {};
            data._tonken = token;
            axios.post(baseURL+'api/areas/'+$(this).val(), data).then((response) => {
                console.log(response.data);
                $('select[name="area_id"]').select2({placeholder: 'Area', data:response.data, width:'100%',tags: true });
            });
        });

        $('select[name="city_id"]').select2({placeholder: 'Seleziona il comune', width:'100%'});
        $('select[name="contract_id"]').select2({placeholder: 'Tipo contratto', width:'100%'});
        $('select[name="type_id"]').select2({placeholder: 'Tipologia', width:'100%'});
        $('select[name="tag_id"]').select2({placeholder: 'Tipologia immobile', width:'100%'});
        $('select[name="area_id"]').select2({placeholder: 'Area', width:'100%',tags: true });
    </script>
@endpush
