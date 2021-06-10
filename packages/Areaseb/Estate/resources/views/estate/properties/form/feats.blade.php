<div class="col-md-6">
    <div class="card card-outline card-danger">
        <div class="card-header">
            <h3 class="card-title">Dettagli</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Riscaldamento</label>
                        {!! Form::select('heating', $heatings, null) !!}
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Classe energetica</label>
                        {!! Form::select('energy_class', config('properties.energy_class'), null) !!}
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>IPE</label>
                        {!! Form::number('ipe', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Al piano</label>
                        {!! Form::number('floor', null, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        <label>N. Bagni</label>
                        {!! Form::number('n_bathrooms', null, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        <label>N. Camere</label>
                        {!! Form::number('n_bedrooms', null, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        <label>N. Garage</label>
                        {!! Form::number('n_garages', null, ['class' => 'form-control']) !!}
                    </div>
                </div>


            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>N. Piani</label>
                        {!! Form::number('n_floors', null, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Mq immobile</label>
                        {!! Form::number('surface', null, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Mq Lotto</label>
                        {!! Form::number('land_surface', null, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Mq Giardino</label>
                        {!! Form::number('garden_surface', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('estate::estate.properties.form.info')
    @include('estate::estate.properties.form.prices')
    @include('estate::estate.properties.form.extra')
    

</div>




@push('scripts')
    <script>

        $('select[name="heating"]').select2({placeholder: 'Riscaldamento', width:'100%', tags: true, allowClear:true});
        $('select[name="energy_class"]').select2({placeholder: 'Classe', width:'100%'});
    </script>
@endpush
