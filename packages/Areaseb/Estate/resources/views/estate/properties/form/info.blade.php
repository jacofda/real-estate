<div class="col-md-12">
    <div class="card card-outline card-success">
        <div class="card-header">
            <h3 class="card-title">Info</h3>
        </div>
        <div class="card-body">

                <div class="row">

                    <div class="col">
                        <div class="form-group">
                            <label>Data di Acquisizione</label>
                            <div class="input-group date" id="aquired_at" data-target-input="nearest">
                                {!! Form::text('aquired_at', null, ['class' => 'form-control datetimepicker-input', 'data-target' => '#aquired_at']) !!}
                                <div class="input-group-append" data-target="#aquired_at" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label>Status</label>
                            {!! Form::select('status', config('properties.status'), null, ['class' => 'form-control']) !!}
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col">
                        <div class="form-group">
                            <label>Data di Costruzione</label>
                            {{-- {!! Form::text('built_at', null, ['class' => 'form-control']) !!} --}}

                            <div class="input-group date" id="built_at" data-target-input="nearest">
                                {!! Form::text('built_at', null, ['class' => 'form-control datetimepicker-input', 'data-target' => '#built_at']) !!}
                                <div class="input-group-append" data-target="#built_at" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label>Condizione</label>
                            {!! Form::select('state', $states, null, ['class' => 'form-control']) !!}
                        </div>
                    </div>

                </div>


        </div>
    </div>

</div>

@push('scripts')
    <script>
        $('select[name="state"]').select2({placeholder: 'Seleziona Stato', width:'100%', tags: true, allowClear:true});
        $('select[name="status"]').select2({placeholder: 'Seleziona Status', width:'100%', allowClear:true});
        $('#built_at').datetimepicker({format: "YYYY"});
        $('#aquired_at').datetimepicker({format: "DD/MM/YYYY"});
    </script>
@endpush
