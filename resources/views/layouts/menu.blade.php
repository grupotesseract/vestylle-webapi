<li class="{{ Request::is('pessoas*') ? 'active' : '' }}">
    <a href="{!! route('pessoas.index') !!}"><i class="fa fa-user"></i><span>Pessoas</span></a>
</li>
<li class="{{ Request::is('faleConoscos*') ? 'active' : '' }}">
    <a href="{!! route('faleConoscos.index') !!}"><i class="fa fa-envelope"></i><span>Fale Conosco</span></a>
</li>
<li class="{{ Request::is('cupons*') ? 'active' : '' }}">
    <a href="{!! route('cupons.index') !!}"><i class="fa fa-tag"></i><span>Cupons</span></a>
</li>
<li class="{{ Request::is('ofertas*') ? 'active' : '' }}">
    <a href="{!! route('ofertas.index') !!}"><i class="fa fa-money"></i><span>Ofertas</span></a>
</li>
<li class="{{ Request::is('lojas*') ? 'active' : '' }}">
    <a href="/lojas/1/edit"><i class="fa fa-home"></i><span>A Loja</span></a>
</li>
