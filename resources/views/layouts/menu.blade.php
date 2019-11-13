<!-- Dropdown Menu Pessoas -->
<li class="treeview {{ Request::is('*pessoas*') ? 'active menu-open' : '' }}">
    <a href="javascript:void(0)"><i class="fa fa-users"></i><span>Pessoas</span></a>

    <ul class="nav treeview-menu">
        <li class="{{ Request::is('*pessoas*') ? 'active' : '' }}">
            <a href="{!! route('pessoas.index') !!}"></i><span> Todas</span></a>
        </li>
        <li class="{{ Request::is('*pessoas-notificacoes*') ? 'active' : '' }}">
            <a href="{!! route('pessoas.notificacoes') !!}"></i><span>Que permitiram notificações</span></a>
        </li>
    </ul>
</li>

<li class="{{ Request::is('faleConoscos*') ? 'active' : '' }}">
    <a href="{!! route('faleConoscos.index') !!}"><i class="fa fa-envelope"></i><span>Contatos</span></a>
</li>
<li class="{{ Request::is('cupons*') ? 'active' : '' }}">
    <a href="{!! route('cupons.index') !!}"><i class="fa fa-tag"></i><span>Cupons</span></a>
</li>
<li class="{{ Request::is('ofertas*') ? 'active' : '' }}">
    <a href="{!! route('ofertas.index') !!}"><i class="fa fa-money"></i><span>Produtos</span></a>
</li>
<li class="{{ Request::is('lojas*') ? 'active' : '' }}">
    <a href="/lojas/1"><i class="fa fa-home"></i><span>A Loja</span></a>
</li>
<li class="{{ Request::is('categorias*') ? 'active' : '' }}">
    <a href="/categorias"><i class="fa fa-list-alt"></i><span>Categorias</span></a>
</li>
<li class="{{ Request::is('tipoInformacaos*') ? 'active' : '' }}">
    <a href="{!! route('tipoInformacaos.index') !!}"><i class="fa fa-asterisk"></i><span>Tipos de Informações</span></a>
</li>
<li class="{{ Request::is('campanhas*') ? 'active' : '' }}">
    <a href="{!! route('campanhas.index') !!}"><i class="fa fa-mail-forward"></i><span>Campanhas</span></a>
</li>

