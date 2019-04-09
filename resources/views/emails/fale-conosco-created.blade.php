@component('mail::message')
# Mensagem recebida pelo Fale Conosco da $loja->nome

Usuário: {{ $faleConosco->pessoa }}

Contato: {{ $faleConosco->contato }}

Assunto: {{ $faleConosco->assunto }}

Mensagem:
{{ $faleConosco->mensagem }}
@endcomponent
