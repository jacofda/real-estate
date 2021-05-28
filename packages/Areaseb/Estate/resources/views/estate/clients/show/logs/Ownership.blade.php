<tr>
    <td><span class="badge bg-{{$log->class}}">{{$log->trans_class}}</td>
    <td data-sort="{{$log->created_at->timestamp}}">{{$log->created_at->format('d/m/Y')}}</td>
    <td>
        @if($log->property)
            {{$log->property->name_it}}
        @endif
    </td>
    <td> dal {{$log->from->format('d/m/Y')}}</td>
    <td>
        <a title="elimina {{$log->trans_class}}"class="btn btn-sm btn-danger logDelete" href="{{route($log->directory.'.destroy', $log->id)}}"><i class="fa fa-trash"></i></a>
        <a title="modifica {{$log->trans_class}}" class="btn btn-sm btn-warning" href="{{route($log->directory.'.edit', $log->id)}}"><i class="fa fa-edit"></i></a>
        <a title="dettagli {{$log->trans_class}}" class="btn btn-sm btn-primary" href="{{route($log->directory.'.show', $log->id)}}"><i class="fa fa-eye"></i> </a>
    </td>
</tr>
