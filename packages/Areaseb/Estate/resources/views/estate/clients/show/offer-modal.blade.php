<div class="modal" tabindex="-1" role="dialog" id="offer-modal">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Aggiungi Offerta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            {!! Form::open(['url' => route('offers.store')]) !!}

                {!! Form::hidden('previous_url', url()->full()) !!}

                <div class="modal-body">
                    <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Immobile</label>
                                {!! Form::select('properties_id', $properties, null, ['id' => 'selectPropertiesOffer']) !!}
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Offerta Economica</label>
                                {!! Form::text('offer', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Note</label>
                                {!! Form::textarea('note', null, ['class' => 'form-control', 'rows' => 4, 'placeholder' => 'Riassunto veloce della richiesta']) !!}
                            </div>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Chiudi</button>
                    <button type="submit" class="btn btn-primary btn-save-offer"> <i class="fa fa-save"></i> Salva</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
