@extends('estate::layouts.app')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{config('app.url')}}requests">Richiesta</a></li>
@stop

@include('estate::layouts.elements.title', ['title' => 'Crea Richiesta'])


@section('content')

    {!! Form::open(['url' => route('requests.store'), 'autocomplete' => 'off']) !!}
        <div class="row">
            @include('estate::components.errors')

            <div class="col-md-8 offset-md-2">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Caratteristiche Base</h3>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {!! Form::select('contact_id', $contacts, null, ['id' => 'selectContactrequest']) !!}
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    {!! Form::select('property_id', $properties, null, ['id' => 'selectPropertiesRequest']) !!}
                                </div>
                            </div>

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
                                    {!! Form::text('citta', null, ['class' => 'form-control', 'placeholder' => 'Comune/Città']) !!}
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
                    <div class="card-footer p-0">
                        <button disabled type="submit" class="btn btn-primary btn-sm btn-block btn-save-request"> <i class="fa fa-save"></i> Salva</button>
                    </div>
                </div>
            </div>

        </div>
    {!! Form::close() !!}

@stop

@section('scripts')
<script>
    $('#selectContactrequest').select2({width:'100%', placeholder:"Seleziona o crea contatto"});
    $('#selectPropertiesRequest').select2({width:'100%', placeholder:"Seleziona immobile"});


    $('#selectContactrequest').on('change', function(){
        if($(this).select2('data')[0].id == 'new')
        {
            $('#createContact').removeClass('d-none');


            $('input[name="email"]').on('focusout', function(){
                let emailInput = $(this);
                axios.post(baseURL+'request-email-exists', {_token:token, email: emailInput.val()}).then((response) => {
                    console.log(response.data);
                    if(response.data != '0')
                    {
                        emailInput.val('');
                        err('Email già presente nel database, associata ad '+response.data)
                    }
                });
            })

            $('button.saveQuickContact').on('click', function(e){
                e.preventDefault()
                let data = {};
                data._token = token;
                data.nome = $('input[name="nome"]').val();
                data.cognome = $('input[name="cognome"]').val();
                data.email = $('input[name="email"]').val();
                data.mobile = $('input[name="mobile"]').val();
                data.citta = $('input[name="citta"]').val();

                if(data.email == "")
                {
                    return false;
                    err('Email è obbligatoria');
                }


                axios.post(baseURL+'request-create-contact', data).then((response) => {
                    pass('Contatto Aggiunto');
                    $('input#contact').val(response.data);
                    $('select[name="type"]').select2({width:'100%', placeholder: 'Origine contatto'})
                    $('#createRequest').removeClass('d-none');
                    $('#createContact').addClass('d-none');
                });
            });
        }
        else
        {
            $('input#contact').val($(this).select2('data')[0].id);
            $('#createContact').addClass('d-none');
            $('select[name="type"]').select2({width:'100%', placeholder: 'Origine contatto'})
            $('#createRequest').removeClass('d-none');
        }
    });

    $('textarea[name="note"]').on('keyup', function(){

        let type = false;
        let created_at = false;

        if($('select[name="type"]').val() != '')
        {
            type = true;
        }

        if(!$('input[name="created_at"]').val().includes('y'))
        {
            created_at = true;
        }

        if(type && created_at)
        {
            $('.btn-save-request').prop('disabled', false);
        }

    });


    $('button.btn-save-request').on('click', function(e){
        let data = {};
        e.preventDefault();
        data._token = token;
        data.type = $('select[name="type"]').val();
        data.created_at = $('input[name="created_at"]').val();
        data.note = $('textarea[name="note"]').val();
        data.contact_id = $('input#contact').val();
        data.property_id = $('#selectPropertiesRequest').val();

        axios.post(baseURL+'requests', data).then((response) => {
            if(response.data == 'done')
            {
                window.location.href = "{{route('requests.index')}}";
            }
            else
            {
                console.log(response.data);
            }
        });

    });


</script>
@stop
