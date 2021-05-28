<div class="col-md-12">
    <div class="card card-outline card-success">
        <div class="card-header">
            <h3 class="card-title">Extra</h3>
        </div>
        <div class="card-body">
            <div class="form-group">
                {!! Form::select('feats[]', $feats, $featsSelected, ['multiple']) !!}
            </div>
        </div>
    </div>
    <div class="card">
        <button type="submit" class="btn btn-success btn-lg"><i class="fa fa-save"></i> Salva</button>
    </div>
</div>

@push('scripts')
    <script>
        $('select[name="feats[]"]').select2({placeholder: 'Caratteristiche', width: '100%'});
    </script>
@endpush
