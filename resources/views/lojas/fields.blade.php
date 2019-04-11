<!-- Nome Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nome', 'Nome:') !!}
    {!! Form::text('nome', null, ['class' => 'form-control']) !!}
</div>

<!-- Cor Primaria Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cor_primaria', 'Cor Primária:') !!}
    {!! Form::text('cor_primaria', null, ['class' => 'form-control jscolor']) !!}
</div>

<!-- Cor Secundaria Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cor_secundaria', 'Cor Secundária:') !!}
    {!! Form::text('cor_secundaria', null, ['class' => 'form-control jscolor']) !!}
</div>

<!-- Cor Terciaria Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cor_terciaria', 'Cor Terciária:') !!}
    {!! Form::text('cor_terciaria', null, ['class' => 'form-control jscolor']) !!}
</div>

<!-- Endereco Field -->
<div class="form-group col-sm-6">
    {!! Form::label('endereco', 'Endereço:') !!}
    {!! Form::text('endereco', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::text('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Whatsapp Field -->
<div class="form-group col-sm-6">
    {!! Form::label('whatsapp', 'Whatsapp:') !!}
    {!! Form::textarea('whatsapp', null, ['class' => 'form-control']) !!}
</div>

<!-- Telefone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('telefone', 'Telefone:') !!}
    {!! Form::text('telefone', null, ['class' => 'form-control']) !!}
</div>

<!-- Horario Funcionamento Field -->
<div class="form-group col-sm-6">
    {!! Form::label('horario_funcionamento', 'Horário de Funcionamento:') !!}
    {!! Form::textarea('horario_funcionamento', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('lojas.index') !!}" class="btn btn-default">Cancelar</a>
</div>

