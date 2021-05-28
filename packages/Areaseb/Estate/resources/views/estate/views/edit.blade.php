@extends('estate::layouts.app')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{config('app.url')}}views">Viste</a></li>
@stop

@include('estate::layouts.elements.title', ['title' => 'Crea Visita'])


@section('content')

    {!! Form::model($view, ['url' => route('views.update', $view->id),  'method' => 'PATCH', 'autocomplete' => 'off']) !!}

        {!! Form::hidden('old_url', url()->previous()) !!}

        <div class="row">
            @include('estate::components.errors')

            <div class="col-md-8 offset-md-2">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Modifica Visita</h3>
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

                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="input-group date" id="schedule" data-target-input="nearest">
                                    <input type="text" name="created_at" class="form-control datetimepicker-input" data-target="#schedule" value="{{$view->created_at->format('d/m/Y H:i')}}"/>
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
                    <div class="card-footer p-0">
                        <button type="submit" class="btn btn-primary btn-sm btn-block btn-save-view"> <i class="fa fa-save"></i> Salva</button>
                    </div>
                </div>
            </div>

        </div>
    {!! Form::close() !!}

@stop

@section('scripts')
<script>

    $('#selectContactrequest').select2({width:'100%'});
    $('#selectPropertiesRequest').select2({width:'100%'});

    $('#schedule').datetimepicker();

</script>
@stop
