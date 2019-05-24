@component('mail::message')
# Mensagem recebida pelo formulario de Fale Conosco

Usuário: {{ $pessoa ? $pessoa->nome : 'Não estava logado'}}

Contato: {{ $contato }}

Assunto: {{ $assunto }}

Mensagem:
{{ $mensagem }}
@endcomponent
