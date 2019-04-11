<li class="{{ Request::is('pessoas*') ? 'active' : '' }}">
    <a href="{!! route('pessoas.index') !!}"><i class="fa fa-edit"></i><span>Pessoas</span></a>
</li>
<li class="{{ Request::is('faleConoscos*') ? 'active' : '' }}">
    <a href="{!! route('faleConoscos.index') !!}"><i class="fa fa-edit"></i><span>Fale Conosco</span></a>
</li>
<li class="{{ Request::is('cupons*') ? 'active' : '' }}">
    <a href="{!! route('cupons.index') !!}"><i class="fa fa-edit"></i><span>Cupons</span></a>
</li>
<li class="{{ Request::is('ofertas*') ? 'active' : '' }}">
    <a href="{!! route('ofertas.index') !!}"><i class="fa fa-edit"></i><span>Ofertas</span></a>
</li>

<li class="{{ Request::is('lojas*') ? 'active' : '' }}">
    <a href="{!! route('lojas.index') !!}"><i class="fa fa-edit"></i><span>Lojas</span></a>
</li>

