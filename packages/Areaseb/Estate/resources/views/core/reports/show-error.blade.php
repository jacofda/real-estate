@extends('estate::layouts.app')


@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{config('app.url')}}newsletters">Newsletter</a></li>
    <li class="breadcrumb-item"><a href="{{config('app.url')}}newsletters/{{$newsletter->id}}/reports">Report</a></li>
@stop

@include('estate::layouts.elements.title', ['title' => 'Errori '.$newsletter->nome])


@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Contatti</h3>
                </div>
                <div class="card-body">
                    <table id="table" class="table table-sm table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Errore</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($contacts as $contact)
                                <tr>
                                    <td><a href="{{$contact->url}}" class="defaultColor">{{$contact->fullname}}</a></td>
                                    <td>{{$contact->email}}</td>
                                    <td><small>{{$contact->reports()->where('newsletter_id', $newsletter->id)->first()->error}}</small></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@stop

@section('scripts')
<script>
    $("#table").DataTable(window.tableOptions);
</script>
@stop
