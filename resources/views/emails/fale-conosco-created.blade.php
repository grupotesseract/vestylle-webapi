@component('mail::message')
# Mensagem recebida pelo Fale Conosco da {{ $lojaNome }}

Usuário: {{ $pessoa }}

Contato: {{ $contato }}

Assunto: {{ $assunto }}

Mensagem:
{{ $mensagem }}
@endcomponent
