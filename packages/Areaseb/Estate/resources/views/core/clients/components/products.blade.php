@php
    $items = Areaseb\Estate\Models\Item::whereIn('invoice_id', $client->invoices()->pluck('invoices.id'))->with('invoice')->get()
@endphp

    <div class="table-responsive">
        <table id="table" class="table table-sm table-striped">
            <thead>
                <th>Prodotto</th>
                <th>Qta</th>
                <th>Totale</th>
                <th>Fattura</th>
                <th>Data</th>
            </thead>
            <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>{{$item->product->nome}}</td>
                        <td>{{$item->qta}}</td>
                        <td>€ {{number_format(($item->totale_riga+$item->iva), 2, ',', '.')}}</td>
                        <td>{{$item->invoice->titolo}}</td>
                        <td data-ordable="{{$item->invoice->data->timestamp}}">{{$item->invoice->data->format('d/m/Y')}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@push('scripts')
<script>
    $("#table").DataTable(window.tableOptions);
</script>
@endpush
