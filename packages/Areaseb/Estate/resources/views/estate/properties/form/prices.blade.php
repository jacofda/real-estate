<div class="col-md-12">
    <div class="card card-outline card-warning">
        <div class="card-header">
            <h3 class="card-title" style="line-height:1.5">Prezzi</h3>
            <div class="card-tools">
                {!! Form::select('show_price', [0=>'Nascosto', 1=>'Pubblico'],null, ['class' => 'custom-select custom-select-sm']) !!}
            </div>
        </div>
        <div class="card-body">

            <div class="row" id="affitto">

                {{-- <div class="col">
                    <div class="form-group">
                        <label>Pubblico</label>
                        {!! Form::select('show_price', [0=>'No', 1=>'Sì'],null, ['class' => 'custom-select']) !!}
                    </div>
                </div> --}}

                <div class="col">
                    <div class="form-group">
                        <label>Periodo</label>
                        {!! Form::select('rent_period', [''=>'', 'Giornaliero' => 'Giornaliero', 'Settimanale' => 'Settimanale', 'Mensile' => 'Mensile'],null, ['class' => 'custom-select']) !!}
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <label>Prezzo Affitto</label>
                        {!! Form::text('rent_price', null, ['class' => 'form-control']) !!}
                    </div>
                </div>

            </div>

            <div class="row" id="vendita">


                <div class="col">
                    <div class="form-group">
                        <label>Prezzo Vendita</label>
                        {!! Form::text('sell_price', null, ['class' => 'form-control']) !!}
                    </div>
                </div>

{{-- data-inputmask='"mask": "(999) 999-9999"' data-mask --}}

            </div>

        </div>
    </div>
</div>

@push('scripts')
    <script>

    $('[data-mask]').inputmask()

    let contract = $('select[name="contract_id"]').select2('data')

    $('select[name="show_price"]').on('change', function(){
        swichShowPrice();
    });

    function swichShowPrice()
    {
        let obj = $('select[name="show_price"]');
        let bol = parseInt(obj.val());
        if(bol)
        {
            obj.removeClass('bg-danger');
            obj.addClass('bg-success');
        }
        else
        {
            obj.removeClass('bg-success');
            obj.addClass('bg-danger');
            console.log('remove');
        }
    }
    swichShowPrice();


    function switchPrices(contract)
    {
        if(contract.length)
        {
            if(contract[0].text == 'Affitto')
            {
                $('#vendita').addClass('d-none');
                $('#affitto').removeClass('d-none');
            }
            else if(contract[0].text == 'Vendita')
            {
                $('#affitto').addClass('d-none');
                $('#vendita').removeClass('d-none');
            }
            else
            {
                $('#affitto').removeClass('d-none');
                $('#vendita').removeClass('d-none');
            }
        }
    }

    $('select[name="contract_id"]').on('change', function(){
        contract = $('select[name="contract_id"]').select2('data');
        switchPrices(contract)
    });
    switchPrices(contract)



    </script>
@endpush
