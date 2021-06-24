@php
    $hide = $client->sheets->isEmpty();
@endphp


<div class="card @if($hide) collapsed-card @endif">
    <div class="card-header bg-Sheet">
        <h3 class="card-title l15">
            <a title="visualizza visite" href="#" class="updateDataTable text-white" data-search="Foglio di visita"><u>Fogli di visita</u></a>
        </h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool text-white" data-card-widget="collapse"><i class="fas @if($hide) fa-plus @else fa-minus @endif"></i></button>
            <a title="aggiungi foglio di visita" class="btn btn-xxs btn-primary" href="{{ '#'/*route('sheet.create')*/ }}?client_id={{ $client->id }}"><i class="fas fa-plus"></i></a>
        </div>

    </div>

    @if(!$client->views->isEmpty())
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-sm mb-0 firstRowNoBorder">
                    <tbody>
                        <tr>
                            <td>Tot:{{ $client->sheets->count() }}</td>
                        </tr>
                        {{-- @foreach ($client->views()->latest()->get() as $view)
                            <tr>
                                <td>{{$view->property->name_it}}</td>
                                <td>{{$view->created_at->format('d/m/Y H:i')}}</td>
                                <td><a href="#" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a></td>
                            </tr>
                        @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
