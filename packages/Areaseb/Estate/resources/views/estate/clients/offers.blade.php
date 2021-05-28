@php
    if(!isset($ps))
    {
        $ps = $contact->preference->properties()->get();
    }
@endphp

<div class="card-header">
    <h3 class="card-title">Immobili da proporre</h3>
    <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
    </div>
</div>
<div class="card-body p-0">

    <div class="table-responsive">
        <br>
        <table id="table" class="table table-sm">
            <thead>
                <tr>
                    <th data-sortable="false" style="width:25px;"></th>
                    <th style="width:40px;">Rif</th>
                    <th data-sortable="false" style="width:45px;"></th>
                    <th style="width:180px;">Nome</th>
                    <th data-sortable="false"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($ps as $p)
                    <tr>
                        <td style="padding-left:1rem;"><input type="checkbox" value="{{$p->id}}"></td>
                        <td>{{$p->rif}}</td>
                        <td><a target="_BLANK" href="{{$p->original}}"><img src="{{$p->thumb}}" style="width:45px;"></a></td>
                        <td><a href="{{$p->url}}"><small>{{$p->name_it}}</small></a></td>
                        <td></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
<div class="card-footer text-center">
    
</div>
