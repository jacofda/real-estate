<div class="card">
    <div class="card-header">
        <h3 class="card-title">Homepage</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col mb-0">
                <div class="form-group mb-0">
                    {!! Form::select('highlighted', [''=>'No', 1=>'Sì']) !!}
                </div>
            </div>
            <div class="col">
                <div class="form-group mb-0">
                    {!! Form::select('discounted', [''=>'No', 1=>'Sì']) !!}
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $('select[name="highlighted"]').select2({width:'100%', placeholder:"In evidenza", allowClear:true});
    $('select[name="discounted"]').select2({width:'100%', placeholder:"In offerta", allowClear:true});
</script>
@endpush
