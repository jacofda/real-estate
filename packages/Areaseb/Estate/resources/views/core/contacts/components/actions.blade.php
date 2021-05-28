{!! Form::open(['method' => 'delete', 'url' => route('contacts.destroy', $contact->id), 'id' => "form-".$contact->id]) !!}

    <a href="{{$contact->url}}/edit" class="btn btn-warning btn-icon btn-sm"><i class="fa fa-edit"></i></a>

    @can('contacts.delete')
        <button type="submit" id="{{$contact->id}}" class="btn btn-danger btn-icon btn-sm delete"><i class="fa fa-trash"></i></button>
    @endcan


{!! Form::close() !!}


@if($contact->cellulare)
    @if($contact->int_number)
        <a style="position:absolute; right:3px; top:5px;" target="_BLANK" href="https://web.whatsapp.com/send?phone={{$contact->int_number}}&text=Salve Gentile {{$contact->fullname}}" class="btn btn-sm btn-success"><i class="fab fa-whatsapp"></i></a>
    @endif
@endif
