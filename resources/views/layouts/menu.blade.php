<li class="{{ Request::is('pessoas*') ? 'active' : '' }}">
    <a href="{!! route('pessoas.index') !!}"><i class="fa fa-edit"></i><span>Pessoas</span></a>
</li>

<li class="{{ Request::is('faleConoscos*') ? 'active' : '' }}">
    <a href="{!! route('faleConoscos.index') !!}"><i class="fa fa-edit"></i><span>Fale Conoscos</span></a>
</li>

