{{-- Blade para select de categorias em formato de tags. --}}
{{-- Necessario passar a variavel 'Model' caso esteja editando --}}

<!-- Select de Categorias  -->
<div class="form-group col-sm-12">
    {!! Form::label('categorias', isset($label) ? $label : 'Categorias') !!} <br>
    {!! Form::select(
        'categorias[]',
        $categorias,
        isset($Model) ? $Model->categorias->pluck('id') : null,
        ['class' => 'form-control select-categorias', 'multiple' => true]
    ) !!}
</div>

