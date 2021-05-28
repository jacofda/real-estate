{{-- <div class="col-sm-6"> --}}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Propietari</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                <button class="btn btn-xxs btn-primary newOwner"><i class="fas fa-plus"></i></button>
            </div>
        </div>
        <div class="card-body">

            @if($property->owners)
                <ul class="list-group">
                    @foreach($property->owners()->orderBy('from', 'DESC')->get() as $owner)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span> <b>{{$loop->count - $loop->index}}°</b> {{$owner->contact->fullname}} <small>dal</small> {{$owner->from->format('d/m/Y')}}</span> <button class="btn btn-xs btn-danger deleteOwnership" data-id="{{$owner->id}}"><i class="fa fa-trash"></i></button>
                        </li>
                    @endforeach
                </ul>
            @endif

            {!! Form::open(['url' => route('properties.add.owner', $property->id), 'class' => 'd-none', 'id' => 'ownerForm']) !!}
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            {!! Form::select('contact_id', $contacts, null) !!}
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="form-group">
                            {!! Form::text('from', null, ['class' => 'form-control', 'id' => 'date-mask', 'data-inputmask' => "'alias': 'datetime', 'inputFormat': 'dd/mm/yyyy'"]) !!}
                        </div>
                    </div>
                    <div class="col-1">
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btnAddOwner" disabled><i class="fa fa-save"></i></button>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}

        </div>
        {{-- <div class="card-footer p-0">
            <button class="btn btn-sm btn-primary btn-block newOwner">inserisci nuovo propietario</button>
        </div> --}}
    </div>
{{-- </div> --}}

@push('scripts')

    <script>

        $('select[name="contact_id"]').select2({placeholder:'inserisci nome', width:'100%'});

        $('input[name="from"]').on('keyup', function(){
            if(!$(this).val().includes('y'))
            {
                $('button.btnAddOwner').prop("disabled", false);
            }
            else
            {
                $('button.btnAddOwner').prop("disabled", true);
            }
        });

        $('button.deleteOwnership').on('click', function(e){
            e.preventDefault();
            $(this).parent('li').remove();
            axios.post(baseURL+'properties/'+$(this).attr('data-id')+'/delete-owner', {_token:token}).then((response) => {
                pass('Propietario eliminato');
            });
        });

        $('button.newOwner').on('click', function(e){
            $('#ownerForm').removeClass('d-none');
        });

    </script>
@endpush
