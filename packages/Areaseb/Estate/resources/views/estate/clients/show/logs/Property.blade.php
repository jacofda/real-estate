<tr>
    <td><span class="badge bg-{{$log->trans_class}}">{{$log->trans_class}}</td>
    <td data-sort="{{$log->created_at->timestamp}}">{{$log->created_at->format('d/m/Y')}}</td>
    <td>
        {{$log->name}}
    </td>
    <td> <span class="truncate">{{$log->description}}</span> </td>
    <td>
        <a title="elimina {{$log->trans_class}}"class="btn btn-sm btn-danger logDelete" href="{{route($log->directory.'.destroy', $log->id)}}"><i class="fa fa-trash"></i></a>
        <a title="modifica {{$log->trans_class}}" class="btn btn-sm btn-warning" href="{{route($log->directory.'.edit', $log->id)}}"><i class="fa fa-edit"></i></a>
        <a title="vedi {{$log->trans_class}}" class="btn btn-sm btn-primary" href="{{route('it.immobile'.'.show', $log->slug ?? $log->name_it)}}"><i class="fa fa-eye"></i> </a>
    </td>
</tr>
