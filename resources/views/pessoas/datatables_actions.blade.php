<div class='btn-group'>
    <a href="{{ route('pessoas.show', $id) }}" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-eye-open"></i>
    </a>
</div>

<div class='btn-group'>
    <a href="{{ route('pessoas.edit', $id) }}" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-edit"></i>
    </a>
</div>

<div class='btn-group'>
{!! Form::open(['route' => ['pessoas.destroy', $id], 'method' => 'delete']) !!}
    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => "return confirm('Você tem certeza?')"
    ]) !!}
{!! Form::close() !!}

</div>

{{-- *@OBS*: 'marcar como utilizado no caixa'. Pegando o id do cupon pela URL  --}}
@if ( isset($mostrarBtnBaixaCaixa) && $mostrarBtnBaixaCaixa )
<div class='btn-group'>
    {!! Form::open(['route' => ['cupons.setUtilizadoVenda', \Request::segments()[1]]]) !!}
    {!! Form::hidden('pessoa_id', $id) !!}
    {!! Form::button('<i class="glyphicon glyphicon-check"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-success btn-xs',
        'onclick' => "return confirm('Marcar esse cupom como utilizado no caixa?')"
    ]) !!}
{!! Form::close() !!}
@endif
</div>
