@extends('estate::layouts.app')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{config('app.url')}}invoices">Fatture</a></li>
@stop

@include('estate::layouts.elements.title', ['title' => $invoice->titolo])

@section('content')

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><b>Pagamento Saldo</b><br><p class="text-muted mb-0">Per il saldo totale usa questo box.</p></h3>
                </div>
                {!! Form::model($invoice, ['url' => $invoice->url.'/update-saldo', 'autocomplete' => 'off', 'method' => 'PATCH', 'id' => 'saldoForm']) !!}
                    <div class="card-body">
                        <div class="form-group">
                            {!! Form::select('tipo_saldo', config('invoice.payment_modes')
                                , null, ['class' => 'form-control', 'data-placeholder' => 'Seleziona Tipo Saldo', 'required']) !!}
                        </div>
                        <div class="form-group">
                            <div class="input-group" id="data_saldo" data-target-input="nearest">
                                @php
                                    $data_saldo = $invoice->data_saldo ? $invoice->data_saldo->format('d/m/Y') : date('d/m/Y');
                                @endphp
                                {!! Form::text('data_saldo', $data_saldo, ['class' => 'form-control', 'data-target' => '#data_saldo', 'data-toggle' => 'datetimepicker']) !!}
                               <div class="input-group-append" data-target="#data_saldo" data-toggle="datetimepicker">
                                   <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                               </div>
                           </div>
                       </div>

                   </div>
                   <div class="card-footer p-0">
                       <button type="submit" class="btn btn-block btn-lg btn-success"><i class="fa fa-save"></i> Salva</button>
                   </div>
                {!! Form::close() !!}
            </div>
        </div>

        @include('estate::core.accounting.payments.info-contacts')


            <div class="col">
                <div class="card" style="border:none;">
                    <div class="card-header" style="border-bottom:none;">
                        <h3 class="card-title">Contatti</h3>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group">
                            <div class="col">
                                <div class="card" style="border:none;">
                                    <div class="card-header" style="border-bottom:none;">
                                        <h3 class="card-title">Contatti</h3>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="list-group">
                                            @forelse($invoice->client->contacts as $contact)
                                                <div class="list-group-item list-group-item-action" style="border-right:none;border-left:none;">
                                                    <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1">{{$contact->fullname}}</h5>
                                                    <small><a href="{{$contact->url}}"><i class="fa fa-eye"></i></a></small>
                                                    </div>
                                                    <p class="mb-1">{{$contact->indirizzo}}, {{$contact->citta}}</p>
                                                    <small>{{$contact->clients()->first()->nome}}</small>
                                                </div>
                                            @empty
                                                <div class="list-group-item list-group-item-action" style="border-right:none;border-left:none;">
                                                    Non hai contatti registrati con questa azienda
                                                </div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>

                @if($invoice->saldato)
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h2 class="mb-0">{{$invoice->total_formatted}}</h2>
                            <p>Saldato</p>
                        </div>
                    </div>
                @else
                    @if($invoice->payments()->exists())
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h2 class="mb-0">€ {{number_format($invoice->total-$invoice->payments()->sum('amount'), 2, ',', '.')}}</h2>
                                <p>ancora da saldare</p>
                            </div>
                        </div>
                    @else
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h2 class="mb-0">{{$invoice->total_formatted}}</h2>
                                <p>da saldare</p>
                            </div>
                        </div>
                    @endif
                @endif

            </div>
        </div>
    </div>



    <div class="row">
        <div class="col">
            <div class="card card-outline card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Rateazione</h3>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table text-center mb-0">
                            <thead>
                                <tr>
                                    <th style="border-top:none;">Data</th>
                                    <th style="border-top:none;">Tipo di pagamento</th>
                                    <th style="border-top:none;">Importo</th>
                                    <th style="border-top:none;"></th>
                                </tr>
                            </thead>
                            <tbody>

                                @php
                                    $da_pagare = $invoice->total;
                                @endphp

                                @foreach($invoice->payments as $payment)
                                    <tr>
                                        <td>{{$payment->date->format('d/m/Y')}}</td>
                                        <td>{{config('invoice.payment_modes')[$payment->payment_type]}}</td>
                                        <td>€ {{number_format($payment->amount, 2, ',', '.')}}</td>
                                        <td>
                                            {!! Form::open(['url' => route('invoices.payments.delete', $payment->id), 'method' => 'DELETE']) !!}
                                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                    @php
                                        $da_pagare -= $payment->amount;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                @if(!$invoice->saldato)
                    <div class="card-footer">
                        <div class="table-responsive">
                            <table class="table text-center mb-0">
                                {!! Form::open(['url' => route('invoices.payments.store', $invoice->id)]) !!}
                                    <tr>
                                        <td style="border-top:none;">
                                            <div class="form-group mb-0">
                                                <div class="input-group" id="data" data-target-input="nearest">
                                                    {!! Form::text('data', date('d/m/Y'), ['class' => 'form-control', 'data-target' => '#data', 'data-toggle' => 'datetimepicker']) !!}
                                                   <div class="input-group-append" data-target="#data" data-toggle="datetimepicker">
                                                       <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                   </div>
                                               </div>
                                           </div>
                                        </td>
                                        <td style="border-top:none;">
                                            <div class="form-group text-left mb-0">
                                                {!! Form::select('tipo_saldo', config('invoice.payment_modes')
                                                    , 'B', ['class' => 'form-control', 'data-placeholder' => 'Seleziona Tipo Saldo', 'required']) !!}
                                            </div>
                                        </td>
                                        <td style="border-top:none;">
                                            <div class="form-group mb-0">
                                                <div class="input-group">
                                                    {!!Form::text('amount', null, ['class' => 'form-control input-decimal', 'max' => $da_pagare])!!}
                                                    <div class="input-group-append">
                                                        <span class="input-group-text input-group-text-sm">00.00</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="border-top:none;">
                                            <div class="form-group mb-0">
                                                <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Inserisci</button>
                                            </div>
                                        </td>
                                    </tr>
                                {!! Form::close() !!}
                            </table>
                        </div>
                    </div>
                @endif


            </div>
        </div>
    </div>

    @include('estate::core.accounting.payments.invoice-reference')

    @include('estate::core.accounting.payments.notices')


@stop


@section('scripts')
<script>
    $('select[name="tipo_saldo"]').select2({allowClear:true, width: '100%'});
    $('select[name="type"]').select2({placeholder:"Tipo contatto"});
    $('#data_saldo').datetimepicker({ format: 'DD/MM/YYYY' });
    $('#data').datetimepicker({ format: 'DD/MM/YYYY' });
    $('#date-notice').datetimepicker({ format: 'DD/MM/YYYY' });
</script>
@stop
