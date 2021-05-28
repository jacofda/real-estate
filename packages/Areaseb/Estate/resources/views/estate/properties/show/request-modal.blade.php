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
                @php
                    if(\Route::current()->getName() == 'companies.show')
                    {
                        $contactsArray = $contacts;
                        $properties = [''=>'']+\Areaseb\Estate\Models\Property::pluck('name_it', 'id')->toArray();
                    }
                    else
                    {
                        unset( $contacts['']);
                        $contactsArray = [''=>'','new'=>'Nuovo']+$contacts;
                    }
                @endphp
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            {!! Form::select('contact_id', $contactsArray, null, ['id' => 'selectContactrequest']) !!}
                        </div>
                    </div>
                    @if(\Route::current()->getName() == 'companies.show')
                        <div class="col-sm-8">
                            <div class="form-group">
                                {!! Form::select('properties_id', $properties, null, ['id' => 'selectPropertiesRequest']) !!}
                            </div>
                        </div>
                    @endif
                </div>
                <div class="row d-none" id="createContact">
                    <div class="col-sm-4">
                        <div class="form-group">
                            {!! Form::text('nome', null, ['class' => 'form-control', 'placeholder' => 'Nome']) !!}
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            {!! Form::text('cognome', null, ['class' => 'form-control', 'placeholder' => 'Cognome']) !!}
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email*']) !!}
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            {!! Form::text('mobile', null, ['class' => 'form-control', 'placeholder' => 'Telefono']) !!}
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            {!! Form::text('citta', null, ['class' => 'form-control', 'placeholder' => 'Comune']) !!}
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <button class="btn btn-success saveQuickContact">Crea Contatto</button>
                        </div>
                    </div>

                </div>
                <div class="row d-none" id="createRequest">
                    {!! Form::hidden('contact_id', null, ['id' => 'contact']) !!}

                    <div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::select('type', [''=>'','Telefono'=>'Telefono', 'Email' => 'Email', 'Passaparola' => 'Passaparola'], null) !!}
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
