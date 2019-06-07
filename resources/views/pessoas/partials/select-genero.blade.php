{{-- Blade para select de generos em formato de tags. --}}
{{-- Necessario passar a variavel 'Model' caso esteja editando --}}

<!-- Select de Categorias  -->
<div class="form-group col-sm-12">
    {!! Form::label('categorias', isset($label) ? $label : 'Generos') !!} <br>
    {!! Form::select(
        'genero',
        array_merge([null => ''], $generos),
        isset($Model) ? $Model->genero : null,
        ['class' => 'form-control select2']
    ) !!}
</div>

