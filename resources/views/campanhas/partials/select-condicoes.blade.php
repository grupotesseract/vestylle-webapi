
{!! Form::select($id, [
    '>' => 'Maior que',
    '>=' => 'Maior ou igual a',
    '=' => 'Igual á',
    '<=' => 'Menor ou igual a',
    '<' => 'Menor que'
], $default, ['class' => 'form-control select-single']) !!}
