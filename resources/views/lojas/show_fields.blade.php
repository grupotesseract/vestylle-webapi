<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $loja->id !!}</p>
</div>

<!-- Nome Field -->
<div class="form-group">
    {!! Form::label('nome', 'Nome:') !!}
    <p>{!! $loja->nome !!}</p>
</div>

<!-- Cor Primaria Field -->
<div class="form-group">
    {!! Form::label('cor_primaria', 'Cor Primária:') !!}
    <p class="color-background">{!! $loja->cor_primaria !!}</p>
</div>

<!-- Cor Secundaria Field -->
<div class="form-group">
    {!! Form::label('cor_secundaria', 'Cor Secundária:') !!}
    <p class="color-background">{!! $loja->cor_secundaria !!}</p>
</div>

<!-- Cor Terciaria Field -->
<div class="form-group">
    {!! Form::label('cor_terciaria', 'Cor Terciária:') !!}
    <p class="color-background">{!! $loja->cor_terciaria !!}</p>
</div>

<!-- Endereco Field -->
<div class="form-group">
    {!! Form::label('endereco', 'Endereço:') !!}
    <p>{!! $loja->endereco !!}</p>
</div>

<!-- Email Field -->
<div class="form-group">
    {!! Form::label('email', 'Email:') !!}
    <p>{!! $loja->email !!}</p>
</div>

<!-- Whatsapp Field -->
<div class="form-group">
    {!! Form::label('whatsapp', 'Whatsapp:') !!}
    <p>{!! $loja->whatsapp !!}</p>
</div>

<!-- Telefone Field -->
<div class="form-group">
    {!! Form::label('telefone', 'Telefone:') !!}
    <p>{!! $loja->telefone !!}</p>
</div>

<!-- Horario Funcionamento Field -->
<div class="form-group">
    {!! Form::label('horario_funcionamento', 'Horário de Funcionamento:') !!}
    <p>{!! $loja->horario_funcionamento !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Criado Em:') !!}
    <p>{!! $loja->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Atualizado Em:') !!}
    <p>{!! $loja->updated_at !!}</p>
</div>

<script>
var colorCollection = document.getElementsByClassName("color-background");
var i;
for (i = 0; i < colorCollection.length; i++) {
    colorCollection[i].style.backgroundColor = "#" + colorCollection[i].innerHTML;
}
</script>

