@extends('estate::layouts.app')

@include('estate::layouts.elements.title', ['title' => 'Dati di proprietà ' . $property->rif])


@section('content')
    <div class="row">

        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{$property->name_it}}</h3>
                </div>
                @if($ownership->data)
                    {!! Form::model($ownership->data,['url' => route('ownerships.update', $ownership->id), 'method' => 'PATCH']) !!}
                @else
                    {!! Form::open(['url' => route('ownerships.store')]) !!}
                @endif

                {!!Form::hidden('ownership_id', $ownership->id)!!}

                <div class="card-body">

                    <div class="form-group">
                        <label>Descrizione</label>
                        @php
                            $description = null;
                            if($ownership->data)
                            {
                                $description = $ownership->data->description;
                            }
                        @endphp
                        {!! Form::textarea('description', $description, ['class'=>'form-control', 'rows' => 4]) !!}
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Tipo</label>

                                @php
                                    $type = null;
                                    if($ownership->data)
                                    {
                                        $type = $ownership->data->type;
                                    }
                                @endphp

                                {!! Form::select('type', config('properties.ownership_types'), $type, ['class'=>'custom-select']) !!}
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Atto di provenienza</label>

                                @php
                                    $document_origin = null;
                                    if($ownership->data)
                                    {
                                        $document_origin = $ownership->data->document_origin;
                                    }
                                @endphp

                                {!! Form::select('document_origin', config('properties.document_origin'), $document_origin, ['class'=>'custom-select']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Vicini</label>

                        @php
                            $neighbors = null;
                            if($ownership->data)
                            {
                                $neighbors = $ownership->data->neighbors;
                            }
                        @endphp

                        {!! Form::textarea('neighbors', $neighbors, ['class'=>'form-control', 'rows' => 2]) !!}
                    </div>

                    @if($ownership->data)

                        @foreach($ownership->data->owners as $owner)

                            @if($loop->index != 0)
                                <div class="wrap-owner">
                                    <div class="form-group" style="position:relative">
                                        <label>Nome e Cognome</label><a href="#" style="position:absolute;right:0;top:-5px" class="btn btn-xs btn-danger deleteOwner"><i class="fa fa-trash"></i></a>
                                        {!! Form::text('nome[]', $owner->nome, ['class'=>'form-control']) !!}
                                    </div>

                                    <div class="form-group">
                                        <label>Codice Fiscale</label>
                                        {!! Form::text('cf[]', $owner->cf, ['class'=>'form-control']) !!}
                                    </div>
                                </div>
                            @else


                                    <div class="form-group">
                                        <label>Nome e Cognome</label>
                                        {!! Form::text('nome[]', $owner->nome, ['class'=>'form-control']) !!}
                                    </div>

                                    <div class="form-group">
                                        <label>Codice Fiscale</label>
                                        {!! Form::text('cf[]', $owner->cf, ['class'=>'form-control']) !!}
                                    </div>


                            @endif

                        @endforeach

                    @else

                        <div class="form-group">
                            <label>Nome e Cognome</label>
                            {!! Form::text('nome[]', $client->primary->fullname, ['class'=>'form-control']) !!}
                        </div>

                        <div class="form-group">
                            <label>Codice Fiscale</label>
                            {!! Form::text('cf[]', null, ['class'=>'form-control']) !!}
                        </div>

                    @endif



                    <a href="#" class="btn btn-sm btn-primary btn-block addOwner mb-3"><i class="fa fa-plus"></i> Aggiungi proprietario</a>
                    <div id="otherOwners" class="d-none">

                    </div>

                </div>
                <div class="card-footer p-0">
                     <button type="submit" class="btn btn-success btn-block"><i class="fa fa-save"></i> Salva Dati Atto</a>
                </div>
                {!! Form::close() !!}
            </div>
        </div>


        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Documenti</h3>
                </div>
                <div class="card-body">
                    @if($ownership->media()->where('mime', 'doc')->exists())
                        <table class="table table-sm table-bordered doc-table mb-0 pb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th>Tipo Documento</th>
                                    <th>Filename</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ownership->media as $file)
                                    <tr>
                                        <td>
                                            {{$file->description}}
                                        </td>
                                        <td>
                                            <a class="badge badge-secondary" target="_BLANK" href="{{$file->doc}}">{{$file->filename}}</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
                <div class="card-footer text-right p-2">
                    <a href="{{route('ownerships.media', $ownership->id)}}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> Aggiungi/Modifica Documenti</a>
                </div>
            </div>
        </div>



    </div>
@stop

@push('scripts')
<script>
let html = `<div class="wrap-owner"><div class="form-group" style="position:relative">
        <label>Nome e Cognome </label><a href="#" style="position:absolute;right:0;top:-5px" class="btn btn-xs btn-danger deleteOwner"><i class="fa fa-trash"></i></a>
        <input class="form-control" name="nome[]" type="text" value="">
    </div>
    <div class="form-group">
        <label>Codice Fiscale</label>
        <input class="form-control" name="cf[]" type="text" value="">
    </div></div>`;

$('a.addOwner').on('click', function(e){
    e.preventDefault();
    $('#otherOwners').removeClass('d-none');
    $('#otherOwners').append(html);
});

$('#otherOwners').on('click', 'a.deleteOwner', function(e){
    e.preventDefault();
    $(this).parent('div').parent('div').remove();
});

$('a.deleteOwner').on('click', function(e){
    e.preventDefault();
    $(this).parent('div').parent('div').remove();
});





</script>
@endpush
