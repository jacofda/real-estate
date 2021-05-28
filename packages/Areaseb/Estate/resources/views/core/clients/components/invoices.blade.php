@if($client->invoices()->count() < 8)

    @foreach($client->invoices()->orderBy('data','DESC')->get() as $invoice)

        <div class="card @if(!$loop->last) collapsed-card @endif">
            <div class="card-header bg-lightblue card-header-sm">
                <h3 class="card-title">{{$invoice->titolo}} - {{$invoice->data->format('d/m/Y')}}</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fas @if(!$loop->last) fa-plus @else fa-minus @endif"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="small-box text-center">
                            Imponibile<br>
                            <small>{{$invoice->imponibile_formatted}}</small>
                        </div>
                    </div>
                    <div class="col">
                        <div class="small-box text-center">
                            Imposte<br>
                            <small>{{$invoice->percent_iva}}</small>
                        </div>
                    </div>
                    <div class="col">
                        <div class="small-box text-center">
                            Totale<br>
                            <small>{{$invoice->total_formatted}}</small>
                        </div>
                    </div>
                    <div class="col">
                        <div class="small-box text-center">
                            Scadenza<br>
                            <small>{{$invoice->data_scadenza->format('d/m/Y')}}</small>
                        </div>
                    </div>
                    <div class="col">
                        <div class="small-box text-center">
                            Pagamento<br>
                            <small>{{$invoice->tipo_pagamento}}</small>
                        </div>
                    </div>
                    <div class="col">
                        <div class="small-box text-center">
                            Saldato<br>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input switch" data-id="{{$invoice->id}}" id="customSwitch-{{$invoice->id}}" @if($invoice->saldato) checked @endif>
                                <label class="custom-control-label saldato" for="customSwitch-{{$invoice->id}}"></label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="table-responsive">
                        <table class="table table-lg">
                            <thead>
                                <tr>
                                    <th width="48%;">Descrizione</th>
                                    <th>Qta</th>
                                    <th>Prezzo</th>
                                    <th>Sconto</th>
                                    <th>Tot. Riga</th>
                                    <th>%IVA</th>
                                    <th>IVA</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($invoice->items as $item)
                                    <tr id="row-{{$item->id}}" data-model="Item" data-id="{{$item->id}}">
                                        <td>
                                            <h6 class="mb-0">
                                                @if($item->product)
                                                    {{$item->product->nome}}
                                                @endif
                                            </h6>
                                            <span>{{$item->descrizione}}</span>
                                        </td>
                                        <td>{{$item->qta}}</td>
                                        <td>{{$item->importo_formatted}}</td>
                                        <td class="">{{round($item->sconto, 2)}} %</td>
                                        <td class="">{{$item->totale_riga_formatted}}</td>
                                        <td class="">{{$item->perc_iva}} %</td>
                                        <td class="">{{$item->iva_formatted}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
        </div>

    @endforeach

@else

    <div class="table-responsive">
        <table class="table table-sm table-font-xs table-bordered table-striped table-php expandable">
            <thead>
                <tr>
                    <th data-field="tipo" data-order="asc">Tipo <i class="fas fa-sort"></i></th>
                    <th data-field="numero" data-order="asc">Numero <i class="fas fa-sort"></i></th>
                    <th data-field="data" data-order="asc">Data <i class="fas fa-sort"></i></th>
                    <th data-field="imponibile" data-order="asc">Imponibile <i class="fas fa-sort"></i></th>
                    <th>% Imp.</th>
                    <th>Tot.</th>
                    <th data-field="data_scadenza" data-order="asc">Scadenza <i class="fas fa-sort"></i></th>
                    <th>Pagamento</th>
                    <th>Saldato</th>
                </tr>
            </thead>
            <tbody>
                @foreach($client->invoices()->orderBy('data','DESC')->get() as $invoice)
                    <tr id="row-{{$invoice->id}}">
                        <td class="text-center">{{$invoice->tipo}}</td>
                        <td class="text-center">{{$invoice->numero}}</td>
                        <td>{{$invoice->data->format('d/m/Y')}}</td>
                        <td>{{$invoice->imponibile_formatted}}</td>
                        <td class="text-center">{{$invoice->percent_iva}}</td>
                        <td>{{$invoice->total_formatted}}</td>
                        <td>{{$invoice->data_scadenza->format('d/m/Y')}}</td>
                        <td>{{$invoice->pagamento}}</td>
                        <td class="text-center">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input switch" data-id="{{$invoice->id}}" id="customSwitch-{{$invoice->id}}" @if($invoice->saldato) checked @endif>
                                <label class="custom-control-label saldato" for="customSwitch-{{$invoice->id}}"></label>
                            </div>
                        </td>
                    </tr>
                    <tr class="d-none" id="row-{{$invoice->id}}-expand">
                        <td colspan="2" class="text-center"><b>Prodotti</b></td>
                        <td colspan="7">
                            @foreach($invoice->items as $item)
                                <p style="margin:3px;">{{$item->qta}} x {{$item->product->nome}} <small>({{$item->product->descrizione}})</small> Tot: € {{number_format($item->importo+$item->iva, '2', ',', '.')}}</p>
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif

@push('scripts')
    <script>
        $('table.expandable tr').on('click', function(){
            let rowName = $(this).attr('id');
            $('tr#'+rowName+'-expand').toggleClass('d-none');
        });
    </script>
@endpush
