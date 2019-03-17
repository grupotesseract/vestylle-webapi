<li class="{{ Request::is('pessoas*') ? 'active' : '' }}">
    <a href="{!! route('pessoas.index') !!}"><i class="fa fa-edit"></i><span>Pessoas</span></a>
</li>

<li class="{{ Request::is('cupons*') ? 'active' : '' }}">
    <a href="{!! route('cupons.index') !!}"><i class="fa fa-edit"></i><span>Cupons</span></a>
</li>

