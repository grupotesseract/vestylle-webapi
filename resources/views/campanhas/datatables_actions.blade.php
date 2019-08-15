{!! Form::open(['route' => ['campanhas.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    <a href="{{ route('campanhas.show', $id) }}" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-eye-open"></i>
    </a>
    <a href="{{ route('campanhas.edit', $id) }}" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-edit"></i>
    </a>
    <a onclick="javascript:confirmaDispararCampanha(event)" href="{{route('push', ['idCampanha' => $id])}}" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-pushpin"></i>
    </a>

    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => "return confirm('Tem certeza?')"
    ]) !!}
</div>
{!! Form::close() !!}
<script>
    function confirmaDispararCampanha(ev) {
        console.log('clicou pra disparar heim');
        console.log(ev);
        ev.preventDefault();

        swal({
            title: 'Disparar notificações?',
            type: 'warning',
            showCancelButton: true,
            showConfirmButton: true
        })
            .then( (isConfirm) => {
                if (isConfirm.value) {
                    console.log('confirmado');
                    let location = ev.target.href ? ev.target.href : ev.target.parentElement.href;
                    window.location = location;
                }
            });
    }
</script>
