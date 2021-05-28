
<div class="card collapsed-card">
    <div class="card-header">
        <h3 class="card-title">Catasto</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>Censito a</label>
                    {!! Form::text('censito_a', null, ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="col">
                <div class="form-group">
                    <label>Partita</label>
                    {!! Form::text('partita', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>Mappali</label>
                    {!! Form::text('mappali', null, ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="col">
                <div class="form-group">
                    <label>Categoria</label>
                    {!! Form::text('categoria', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>Foglio</label>
                    {!! Form::text('foglio', null, ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="col">
                <div class="form-group">
                    <label>Particella</label>
                    {!! Form::text('particella', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>Subalterno</label>
                    {!! Form::text('subalterno', null, ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="col">
                <div class="form-group">
                    <label>Rendita</label>
                    {!! Form::text('rendita', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>

    </div>
</div>
