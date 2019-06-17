<!-- Pessoa Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pessoa_id', 'Id da Pessoa:') !!}
    {!! Form::number('pessoa_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Assunto Field -->
<div class="form-group col-sm-6">
    {!! Form::label('assunto', 'Assunto:') !!}
    {!! Form::text('assunto', null, ['class' => 'form-control']) !!}
</div>

<!-- Mensagem Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('mensagem', 'Mensagem:') !!}
    {!! Form::textarea('mensagem', null, ['class' => 'form-control']) !!}
</div>

<!-- Contato Field -->
<div class="form-group col-sm-6">
    {!! Form::label('contato', 'Contato:') !!}
    {!! Form::text('contato', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('faleConoscos.index') !!}" class="btn btn-default">Cancelar</a>
</div>
