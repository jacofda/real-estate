@extends('estate::layouts.app')

@include('estate::layouts.elements.title', ['title' => 'POI'])

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header bg-secondary-light">
                    <div class="card-tools">
                        <div class="btn-group" role="group">
                            <a class="btn btn-primary creable" href="#" data-model="Poi" data-field="name_it"><i class="fas fa-plus"></i> Crea Poi</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Name</th>
                                    <th>N.</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pois as $poi)
                                    <tr id="row-{{$poi->id}}" data-model="Poi" data-id="{{$poi->id}}">
                                        <td class="property-editable" data-field="name_it">{{$poi->name_it}}</td>
                                        <td class="property-editable" data-field="name_en">{{$poi->name_en}}</td>
                                        <td>
                                            {{$poi->properties()->count()}}
                                        </td>
                                        <td>

                                            {!! Form::open(['method' => 'delete', 'url' => route('tags.destroy', $poi->id), 'id' => "form-".$poi->id]) !!}
                                                <button type="submit" id="{{$poi->id}}" class="btn btn-danger btn-icon btn-sm delete"><i class="fa fa-trash"></i></button>
                                            {!! Form::close() !!}

                                        </td>
                                    </tr>
                                @endforeach
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

$('a.creable').on('click', function(e){
    e.preventDefault();
    let field = $(this).attr('data-field');
    let model = $(this).attr('data-model');


    let html = '<div class="input-group mt-2"><input type="text" class="form-control" placeholder="'+field+'"';
    html += 'name="'+field+'"';
    html += 'value="">';
    html += '<div class="input-group-append">';
    html += '<button class="input-group-text saveF btn-success"><i class="fa fa-save"></i></button>';
    html += '<button class="input-group-text closeF btn-danger"><i class="far fa-times-circle"></i></button>';
    html +='</div></div>';
    $('.card-tools').append(html);

    $('button.saveF').on('click', function(){
        let newValue = $(this).parent('div').siblings('input').val();
        let postUrl = baseURL+'create-property-field';
        data = {
            model: model,
            _token: token,
            field: field,
            value: newValue
        }
        $.post(postUrl, data).done(function( response ) {
            if(response !== 'done')
            {
                err('not found');
            }
            else
            {
                location.reload();
            }
        });
    });

});

$('td.property-editable').on('dblclick', function(){
    let cell = $(this);
    let value = cell.text();
    let field = cell.attr('data-field');
    let model = cell.parent('tr').attr('data-model');
    let id = cell.parent('tr').attr('data-id');
    let html = '<div class="input-group"><input type="text" class="form-control" ';
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
