<div class="modal" tabindex="-1" role="dialog" id="log-modal">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Aggiungi Log</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!!Form::open(['url' => route('clientlogs.store')])!!}
                <div class="modal-body">

                    {!! Form::hidden('client_id', $client ? $client->id : null) !!}
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                {!! Form::select('property_id', $properties, null, ['id' => 'selectPropertiesLog']) !!}
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                {!! Form::select('log_type', $logsType, null, ['id' => 'selectLogType']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                {!! Form::textarea('note', null, ['class' => 'form-control', 'placeholder' => 'Scrivi nota qui', 'id' => 'logNote' ]) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Chiudi</button>
                    <button type="submit" class="btn btn-primary btn-save-log"> <i class="fa fa-save"></i> Salva</button>
                </div>
            {{Form::close()}}

        </div>
    </div>
</div>


@push('scripts')
    <script>
        $('#selectPropertiesLog').select2({width:'100%', placeholder: 'Seleziona immobile'});
        $('#selectLogType').select2({width:'100%', placeholder: 'Seleziona tipologia', tags:true});
        $('#logNote').on('keyup', function(){
            $('button.btn-save-log').attr('disabled', false);
        });
    </script>
@endpush
