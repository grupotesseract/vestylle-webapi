<!-- Descricao Oferta Field -->
<div class="form-group col-sm-12">
    {!! Form::label('categorias', 'Categorias') !!}
    {!! Form::select('categorias[]', $categorias, 0, ['class' => 'form-control select-categorias', 'multiple' => true]) !!}
</div>

