@extends('estate::layouts.app')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{config('app.url')}}sheets">Fogli di visita</a></li>
@stop

@include('estate::layouts.elements.title', ['title' => 'Crea Foglio di visita'])


@section('content')

    {!! Form::open(['url' => route('sheets.store'), 'autocomplete' => 'off']) !!}

        {!! Form::hidden('previous_url', url()->previous()) !!}

        <div class="row">
            @include('estate::components.errors')

            <div class="col-md-8 offset-md-2">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Nuova Visita</h3>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {!! Form::select('client_id', $clients, request('client_id'), ['id' => 'selectContactrequest']) !!}
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    {!! Form::select('property_id', $properties, request('property_id'), ['id' => 'selectPropertiesRequest']) !!}
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

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="input-group date" id="schedule" data-target-input="nearest">
                                        <input type="text" name="created_at" class="form-control datetimepicker-input" data-target="#schedule" value="{{date('d/m/Y H:i')}}"/>
                                        <div class="input-group-append" data-target="#schedule" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
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
                        <button disabled type="submit" class="btn btn-primary btn-sm btn-block btn-save-view"> <i class="fa fa-save"></i> Salva</button>
                    </div>
                </div>
            </div>

        </div>
    {!! Form::close() !!}

@stop

@section('scripts')
<script>


@if( request('client_id') || request('property_id') )
    $('#createRequest').removeClass('d-none');
@endif

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
                    $('#createRequest').removeClass('d-none');
                    $('#createContact').addClass('d-none');
                });
            });
        }
        else
        {
            $('#createContact').addClass('d-none');
            $('#createRequest').removeClass('d-none');
        }
    });

    $('textarea[name="note"]').on('keyup', function(){
        let created_at = false;
        if($('input[name="created_at"]').val())
        {
            created_at = true;
        }
        let property = false;
        if($('select[name="property_id"]').val())
        {
            property = true;
        }
        if(created_at && property)
        {
            $('.btn-save-view').prop('disabled', false);
        }
    });


    // $('button.btn-save-view').on('click', function(e){
    //     let data = {};
    //     e.preventDefault();
    //     data._token = token;
    //     data.type = $('select[name="type"]').val();
    //     data.created_at = $('input[name="created_at"]').val();
    //     data.note = $('textarea[name="note"]').val();
    //     data.client_id = $('select[name="client_id"]').val();
    //     data.property_id = $('#selectPropertiesRequest').val();
    //     data.old_url =  $('input[name="old_url"]').val();
    //
    //     // console.log(data);
    //     // return false;
    //
    //     axios.post(baseURL+'views', data).then((response) => {
    //         if(response.data == 'done')
    //         {
    //             window.location.href = "route('views.index')}}";
    //         }
    //         else
    //         {
    //             console.log(response.data);
    //         }
    //     });
    // });


    $('#schedule').datetimepicker();




</script>
@stop
