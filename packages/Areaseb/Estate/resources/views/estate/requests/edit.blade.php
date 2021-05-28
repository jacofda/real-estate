@extends('estate::layouts.app')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{route('requests.index')}}">Richieste</a></li>
@stop

@include('estate::layouts.elements.title', ['title' => 'Modifica Richiesta'])


@section('content')

    {!! Form::model($request, ['url' => route('requests.update', $request->id), 'autocomplete' => 'off', 'method' => 'patch']) !!}

        {!! Form::hidden('previous_url', url()->previous()) !!}

        <div class="row">
            @include('estate::components.errors')

            <div class="col-md-8 offset-md-2">
                <div class="card card-outline card-primary">
                    <div class="card-body">

                        <div class="row">

                            <div class="col-sm-6">
                                <div class="form-group">
                                    {!! Form::select('property_id', $properties, request('property_id'), ['id' => 'selectPropertiesRequest']) !!}
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    {!! Form::select('client_id', $clients, request('client_id'), ['id' => 'selectClientsRequest']) !!}
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    {!! Form::select('type', \Areaseb\Estate\Models\Request::getTypes(), $request->type, ['id' => 'selectTypeRequest']) !!}
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    {!! Form::text('created_at', $request->created_at->format('d/m/Y'), ['class' => 'form-control', 'data-inputmask' => "'alias': 'datetime', 'inputFormat': 'dd/mm/yyyy'"]) !!}
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
                        <button type="submit" class="btn btn-primary btn-sm btn-block btn-save-request"> <i class="fa fa-save"></i> Salva</button>
                    </div>
                </div>
            </div>
        </div>
    {!! Form::close() !!}

@stop

@section('scripts')
<script>
    $('#selectPropertiesRequest').select2({width:'100%', placeholder:"Seleziona immobile"});
    $('#selectClientsRequest').select2({width:'100%', placeholder:"Seleziona cliente"});
    $('#selectTypeRequest').select2({width:'100%', placeholder:"Seleziona tipo", tags:true});
</script>
@stop
