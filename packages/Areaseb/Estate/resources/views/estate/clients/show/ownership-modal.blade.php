<div class="modal" tabindex="-1" role="dialog" id="ownership-modal">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Aggiungi intestatario/a proprietà</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::select('properties_id', $properties, null, ['id' => 'selectPropertiesOwnership']) !!}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::text('from', null, ['class' => 'form-control', 'id' => 'date-mask', 'data-inputmask' => "'alias': 'datetime', 'inputFormat': 'dd/mm/yyyy'", 'placeholder' => 'data di acquisto']) !!}
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Chiudi</button>
                <button type="submit" class="btn btn-primary btn-save-ownership"> <i class="fa fa-save"></i> Salva</button>
            </div>
        </div>
    </div>
</div>
