<div class="card">
    <div class="card-header">
        <h3 class="card-title">Booking</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            {{-- <button title="aggiungi proprietà" class="btn btn-sm btn-primary newProperty"><i class="fas fa-plus"></i></button> --}}
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-sm  table-striped mb-0 firstRowNoBorder">
                <thead>
                    <tr>
                        <th>Immobile</th>
                        <th>Da</th>
                        <th>A</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contact->bookings as $booking)
                        <tr>
                            <td>{{$booking->property->name_it}}</td>
                            <td>{{$booking->from_date->format('d/m/Y')}}</td>
                            <td>{{$booking->to_date->format('d/m/Y')}}</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-primary" data-id="{{$booking->id}}"><i class="fa fa-eye"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
