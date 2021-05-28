

    <div class="card collapsed-card">
        <div class="card-header">
            <h3 class="card-title">Traduzione</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
            </div>
        </div>
        <div class="card-body">

            <div class="form-group">
                <label>Nome EN</label>
                {!! Form::text('name_en', null, ['class' => 'form-control']) !!}
            </div>

            @isset($property)
                <div class="form-group">
                    <label>Slug EN</label>
                    {!! Form::text('slug_en', null, ['class' => 'form-control']) !!}
                </div>
            @endisset

            <div class="form-group">
                <label>Descrizione Corta EN</label>
                {!! Form::text('short_desc_en', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                <label>Descrizione EN</label>
                {!! Form::textarea('desc_en', null, ['class' => 'form-control']) !!}
            </div>

        </div>
    </div>
