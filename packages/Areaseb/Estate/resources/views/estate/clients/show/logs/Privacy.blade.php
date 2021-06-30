<tr>
    <td><span class="badge bg-{{$log->class}}">{{$log->trans_class}}</td>
    <td data-sort="{{$log->created_at->timestamp}}">{{$log->created_at->format('d/m/Y')}}</td>
    <td>
        /
    </td>
    <td>/</td>
    <td>
        <a title="elimina {{$log->trans_class}}"class="btn btn-sm btn-danger logDelete" href="{{route('privacy.destroy', $log->id)}}"><i class="fa fa-trash"></i></a>
    </td>
</tr>
