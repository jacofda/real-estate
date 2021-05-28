@extends('estate::layouts.app')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{route('ownerships.index')}}">Atti</a></li>
    <li class="breadcrumb-item"><a href="{{route('ownerships.show',$model->id)}}">Atto</a></li>
@stop

@section('css')
<link rel="stylesheet" href="{{asset('plugins/dropzone/min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/popup/min.css')}}">
@stop

@include('estate::layouts.elements.title', ['title' => 'Aggiungi media'])


@section('content')

    <div class="col-10 offset-1 mt-5">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Aggiungi media a: {{$model->nome}}</h3>
            </div>
            <div class="card-body">
                <form action="{{route('media.add')}}" class="dropzone" id="dropzoneForm">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="fallback">
                            <input name="file" type="file" multiple />
                            <input name="mediable_type" type="hidden" value="{{$model->class}}" />
                            <input name="mediable_id" type="hidden" value="{{$model->id}}" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

	<div class="clearfix"></div>

    @include('estate::components.media.images')

    @php $documents = \Areaseb\Estate\Models\OwnershipData::documents(); @endphp

    @if($model->media()->where('mime', 'doc')->exists())
        <div class="card card-outline card-warning mt-5">
            <div class="card-header">FILES</div>
            <table class="table table-sm table-bordered doc-table mb-0 pb-0">
                <thead class="thead-light">
                    <tr>
                        <th class="text-center">#</th>
                        <th style="width:400px;" class="text-center">descrizione file</th>
                        <th class="text-center">preview</th>
                        <th class="text-center">size</th>
                        <th class="text-center"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($model->media()->where('mime','doc')->get() as $file)
                        <tr>
                            <td class="align-middle text-center" style="min-width: 50px;">
                                {{$loop->index+1}}
                            </td>
                            <td>
                                <form method="POST" action="{{url('api/media/update')}}" class="col-sm-12 form-description">
                                    {{csrf_field()}}
                                    <input type="hidden" name="id" value="{{$file->id}}">
                                    <div class="form-group mb-0">
                                        <div class="input-group">
                                            {!! Form::select('description', $documents, $file->description) !!}
                                            <div class="input-group-append">
                                                <a href="#" class="btn btn-primary tbr0 upd" id="{{$file->id}}"><i class="fa fa-save"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </td>
                            <td class="align-middle text-center">
                                <a class="btn btn-sm btn-primary" target="_BLANK" href="{{$file->doc}}" >
                                    <small>{{$file->filename}}</small>
                                </a>
                            </td>
                            <td class="align-middle text-center">
                                <small>{{$file->kb}}</small>
                            </td>

                            <td class="align-middle text-center">
                                <form method="POST" action="{{url('api/media/delete')}}">
                                    {{csrf_field()}}
                                    {{method_field('DELETE')}}
                                    <input type="hidden" name="id" value="{{$file->id}}">
                                    <button class="btn btn-sm btn-danger" type="submit"><i class="fa fa-trash" style="width: 20px;height: 25px;padding-top: 4px;"></i> </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif




    <div class="mx-auto mt-5 text-center">
        <a class="btn btn-outline-primary" href="{{route('ownerships.show', $model->id)}}"><i class="fa fa-arrow-left"></i> Torna indietro</a>
    </div>

@stop

@include('estate::components.media.script')

@push('scripts')
    <script>

    $('select[name="description"]').select2({placeholder:'Seleziona tipo di documento', width:'336px',tags: true });

        $('.form-description a.upd').on('click', function(e){
            e.preventDefault();
            var data = {
                '_token': token,
                'id': $(this).attr('id'),
                'description': $(this).parent('div').siblings('select[name=description]').val()
            }
            if(data.description != '')
            {
                $.post( "{{url('api/media/update')}}", data, function(data){
                    new Noty({
                        text: data,
                        type: 'success',
                        theme: 'bootstrap-v4',
                        timeout: 2500,
                        layout: 'topRight'
                    }).show();
                });
            }

        });
    </script>
@endpush
