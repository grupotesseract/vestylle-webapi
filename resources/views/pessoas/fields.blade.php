<!-- Id Vestylle Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_vestylle', 'Id Vestylle:') !!}
    {!! Form::number('id_vestylle', null, ['class' => 'form-control']) !!}
</div>

<!-- Saldo Pontos Field -->
<div class="form-group col-sm-6">
    {!! Form::label('saldo_pontos', 'Saldo Pontos:') !!}
    {!! Form::number('saldo_pontos', null, ['class' => 'form-control']) !!}
</div>

<!-- Celular Field -->
<div class="form-group col-sm-6">
    {!! Form::label('celular', 'Celular:') !!}
    {!! Form::text('celular', null, ['class' => 'form-control']) !!}
</div>

<!-- Telefone Fixo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('telefone_fixo', 'Telefone Fixo:') !!}
    {!! Form::text('telefone_fixo', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Verified At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email_verified_at', 'Email Verified At:') !!}
    {!! Form::date('email_verified_at', null, ['class' => 'form-control']) !!}
</div>

<!-- Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password', 'Password:') !!}
    {!! Form::password('password', ['class' => 'form-control']) !!}
</div>

<!-- Remember Token Field -->
<div class="form-group col-sm-6">
    {!! Form::label('remember_token', 'Remember Token:') !!}
    {!! Form::text('remember_token', null, ['class' => 'form-control']) !!}
</div>

<!-- Nome Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nome', 'Nome:') !!}
    {!! Form::text('nome', null, ['class' => 'form-control']) !!}
</div>

<!-- Cpf Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cpf', 'Cpf:') !!}
    {!! Form::text('cpf', null, ['class' => 'form-control']) !!}
</div>

<!-- Cep Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cep', 'Cep:') !!}
    {!! Form::text('cep', null, ['class' => 'form-control']) !!}
</div>

<!-- Endereco Field -->
<div class="form-group col-sm-6">
    {!! Form::label('endereco', 'Endereco:') !!}
    {!! Form::text('endereco', null, ['class' => 'form-control']) !!}
</div>

<!-- Numero Field -->
<div class="form-group col-sm-6">
    {!! Form::label('numero', 'Numero:') !!}
    {!! Form::text('numero', null, ['class' => 'form-control']) !!}
</div>

<!-- Bairro Field -->
<div class="form-group col-sm-6">
    {!! Form::label('bairro', 'Bairro:') !!}
    {!! Form::text('bairro', null, ['class' => 'form-control']) !!}
</div>

<!-- Complemento Field -->
<div class="form-group col-sm-6">
    {!! Form::label('complemento', 'Complemento:') !!}
    {!! Form::text('complemento', null, ['class' => 'form-control']) !!}
</div>

<!-- Data Ultima Compra Field -->
<div class="form-group col-sm-6">
    {!! Form::label('data_ultima_compra', 'Data Ultima Compra:') !!}
    {!! Form::date('data_ultima_compra', null, ['class' => 'form-control']) !!}
</div>

<!-- Data Nascimento Field -->
<div class="form-group col-sm-6">
    {!! Form::label('data_nascimento', 'Data Nascimento:') !!}
    {!! Form::date('data_nascimento', null, ['class' => 'form-control']) !!}
</div>

<!-- Cidade Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cidade_id', 'Cidade Id:') !!}
    {!! Form::number('cidade_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('pessoas.index') !!}" class="btn btn-default">Cancel</a>
</div>
