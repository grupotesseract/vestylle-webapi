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

<!-- Whatsapp 2 Field -->
<div class="form-group">
    {!! Form::label('whatsapp2', 'Whatsapp:') !!}
    <p>{!! $loja->whatsapp !!}</p>
</div>

<!-- Telefone Field -->
<div class="form-group">
    {!! Form::label('telefone', 'Telefone:') !!}
    <p>{!! $loja->telefone !!}</p>
</div>

@if ($loja->fotos)
<div class="form-group">
    <div class="col-md-6 conteudo-centralizado">
        <image-slider :images="{{ $loja->fotos }}"></image-slider>
    </div>
</div>
@endif

<script>
var colorCollection = document.getElementsByClassName("color-background");
var i;
for (i = 0; i < colorCollection.length; i++) {
    colorCollection[i].style.backgroundColor = "#" + colorCollection[i].innerHTML;
}
</script>

