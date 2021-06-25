@extends('estate::layouts.app')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{config('app.url')}}sheets">Fogli di visita</a></li>
@stop

@include('estate::layouts.elements.title', ['title' => 'Crea Foglio di visita'])

@section('css')
    <style>
        .step-title {
            font-size: 0.875rem;
            line-height: 0.875rem;
        }
    </style>
@stop

@section('content')

    <div class="row">
        @include('estate::components.errors')

        <div class="col-md-8 offset-md-2">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Nuovo foglio di visita</h3>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-12">
                            <h4 class="step-title">1. Scegli il cliente</h4>
                            <div class="form-group">
                                {!! Form::select('client_id', $clients, request('client_id'), ['id' => 'client']) !!}
                            </div>
                        </div>
                    </div>

                    <div id="form" class="d-none">
                        {!! Form::open(['url' => route('sheets.store'), 'autocomplete' => 'off']) !!}
                            {!! Form::hidden('previous_url', url()->previous()) !!}
                            {!! Form::hidden('client_id', request('client_id')) !!}

                            <div class="row">

                                <div class="col-12">
                                    <h4 class="step-title mb-3">2. Scegli le visite da aggiungere al foglio di visita</h4>
                                    <div class="table-responsive">
                                        <table class="table table-sm table-bordered table-striped ">
                                            <thead>
                                                <tr>
                                                    <td>Visita</td>
                                                    <th data-sortable="false" style="width:95px;"></th>
                                                </tr>
                                            </thead>
                                            <tbody id="view-list">
                                                {{-- Loaded using  --}}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        {!! Form::close() !!}

                        <hr>

                        <div class="row">
                            <div class="col-sm-10">
                                <div class="form-group">
                                    {!! Form::select('views', $views, null, ['id' => 'views']) !!}
                                </div>
                            </div>

                            <div class="col-sm-2">
                                <div class="form-group">
                                    <button id="add-view" class="btn btn-primary btn-sm btn-block btn-save-view"> <i class="fa fa-save"></i> Aggiungi</button>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="card-footer p-0">
                    <button class="btn btn-primary btn-sm btn-block btn-save-view" id="submit-sheet" disabled> <i class="fa fa-save"></i> Salva</button>
                </div>
            </div>
        </div>

    </div>

@stop

@section('scripts')
<script>


@if( request('client_id') )
    $('#form').removeClass('d-none')
@endif

    $('#client').select2({width:'100%', placeholder:"Seleziona o crea contatto"})
    $('#views').select2({width:'100%', placeholder:"Seleziona o crea visita"})

    $('#client').on('change', function() {
        let $this = $(this)

        if ($this.val() != 'new') {
            // Open form to create client
        }

        // Let's save the client_id
        $("input[name='client_id']").val($this.val())

        // Open the form
        $('#form').removeClass('d-none');
    })

    $('#add-view').on('click', function () {
        let data = $('#views').select2('data')

        if (data[0].id == 'new') {
            // Open form to create a new view
        } else {
            let view = $(`<tr class="view">
                            <td>
                                <input type="hidden" name="view[]" value="${data['0'].id}" />
                                <span>${data['0'].text}</span>
                            </td>
                            <td><a href="#" class="btn btn-xs btn-danger dlt"><i class="fa fa-trash"></i></a></td>
                        </tr>`)

            // Disable the option, delect the select and append the row into the table
            $("#views > option[value='" + data[0].id + "']").prop('disabled', true)
            $("#views > option").not(':disabled').prop('selected', true)
            $('#view-list').append(view)

            // Let's enable the submit button
            $('#submit-sheet').prop('disabled', false)
        }
    })

    $(document).on('click', '.dlt', function (e) {
        e.preventDefault()
        let $parent = $(this).parent().parent()
        let id = $parent.find('input').val()
        $parent.remove()
        $("#views > option[value='" + id + "']").prop('disabled', false)

        // Disable the button if there is no view selected
        if (!$('.view').length) {
            $('#submit-sheet').prop('disabled', true)
        }
    })

    $('#submit-sheet').on('click', function () {
        $('#form form').submit()
    })
</script>
@stop
