@extends('estate::layouts.app')

@include('estate::layouts.elements.title', ['title' => 'Homepage Slide'])

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header bg-secondary-light">
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Ordine</th>
                                    <th></th>
                                    <th>Titolo</th>
                                    <th>Descrizione Corta</th>
                                    <th>Prezzo</th>
                                    <th>Contratto</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($slides as $property)
                                    <tr id="row-{{$property->id}}" data-model="Property" data-id="{{$property->id}}">
                                        <td class="property-editable" data-field="slide">{{$property->slide}}</td>
                                        <td><a href="{{$property->full}}"><img src="{{$property->thumb}}" style="width:50px"></a></td>
                                        <td>{{$property->name}}</td>
                                        <td>{{$property->short_desc}}</td>
                                        <td>{{$property->prezzo_vendita}}</td>
                                        <td>{{$property->contract->name}}</td>
                                        <td>
                                            {!! Form::open(['url' => route('slides.destroy')]) !!}
                                                    <a href="{{route('properties.edit', $property->id)}}" title="modifica immobile" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>
                                                    {!!Form::hidden('id', $property->id)!!}
                                                    <button type="submit" title="elimina dall'homepage slide" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="7" class="text-center">
                                        <a href="#" title="aggiungi un immobile all'homepage slide" class="badge badge-primary btn-xs my-2 showForm"><i class="fa fa-plus"></i> Aggiungi immobile</a>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="7" class="d-none form">
                                        {!! Form::open(['url' => route('slides.store')]) !!}
                                            <div class="input-group">
                                                {!! Form::select('id', $availables, null) !!}
                                                <div class="input-group-append">
                                                    <button disabled type="submit" class="btn btn-success saveSlide"><i class="fa fa-check"></i> Aggiungi</button>
                                                </div>
                                            </div>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop


@section('scripts')
<script>
    $('select[name="id"]').select2({placeholder:"Seleziona un'immobile", width:'80%'});
    $('select[name="id"]').on('change', function(){
        $('button.saveSlide').attr('disabled', false);
    });
    $('a.showForm').on('click', function(e){
        e.preventDefault();
        $('.form').toggleClass('d-none');
    });


    $('td.property-editable').on('dblclick', function(){
        let cell = $(this);
        let value = cell.text();
        let field = cell.attr('data-field');
        let model = cell.parent('tr').attr('data-model');
        let id = cell.parent('tr').attr('data-id');
        let html = '<div class="input-group"><input type="number" class="form-control" ';
        html += 'name="'+field+'"';
        html += 'value="'+value+'">';
        html += '<div class="input-group-append">';
        html += '<button class="input-group-text saveF btn-success"><i class="fa fa-save"></i></button>';
        html += '<button class="input-group-text closeF btn-danger"><i class="far fa-times-circle"></i></button>';
        html +='</div></div>';
        cell.html(html);

        $('button.saveF').on('click', function(){
            let newValue = $(this).parent('div').siblings('input').val();
            let postUrl = baseURL+'update-property-field';
            cell.html(newValue);
            data = {
                model: model,
                id: id,
                _token: token,
                field: field,
                value: newValue
            }
            $.post(postUrl, data).done(function( response ) {
                if(response !== 'done')
                {
                    err('not found');
                }
            });
        });

        $('button.closeF').on('click', function(){
            cell.html(value);
        });

    });

</script>
@stop
