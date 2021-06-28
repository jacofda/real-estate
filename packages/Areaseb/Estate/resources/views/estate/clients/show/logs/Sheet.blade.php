@php
    $sep = '';
    $properties = '';
    foreach ($log->views as $view) {
        $properties .= $sep . $view->property->rif;
        $sep = ' - ';
    }
@endphp

<tr>
    <td><span class="badge bg-{{$log->class}}">{{$log->trans_class}}</td>
    <td data-sort="{{$log->created_at->timestamp}}">{{$log->created_at->format('d/m/Y')}}</td>
    <td>
        {{ $properties }}
    </td>
    <td>/</td>
    <td>
        <a title="elimina {{$log->trans_class}}"class="btn btn-sm btn-danger logDelete" href="{{route($log->directory.'.destroy', $log->id)}}"><i class="fa fa-trash"></i></a>
        @if (!$log->signed)
            <a title="modifica {{$log->trans_class}}" class="btn btn-sm btn-warning" href="{{route($log->directory.'.edit', $log->id)}}"><i class="fa fa-edit"></i></a>
        @endif
    </td>
</tr>
