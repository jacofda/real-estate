<div class="modal" tabindex="-1" role="dialog" id="request-modal">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Aggiungi Richiesta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group">
                            {!! Form::select('properties_id', $properties, null, ['id' => 'selectPropertiesRequest']) !!}
                        </div>
                    </div>
                </div>
                <div class="row d-none" id="createRequest">
                    <div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::select('request_type', [''=>'','Telefono'=>'Telefono', 'Email' => 'Email', 'Passaparola' => 'Passaparola', 'In Presenza' => 'In Presenza'], null) !!}
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::text('created_at', \Carbon\Carbon::now()->format('d/m/Y'), ['class' => 'form-control', 'data-inputmask' => "'alias': 'datetime', 'inputFormat': 'dd/mm/yyyy'"]) !!}
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            {!! Form::textarea('note', null, ['class' => 'form-control', 'rows' => 4, 'placeholder' => 'Riassunto veloce della richiesta']) !!}
                        </div>
                    </div>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Chiudi</button>
                <button type="submit" class="btn btn-primary btn-save-request"> <i class="fa fa-save"></i> Salva</button>
            </div>
        </div>
    </div>
</div>
