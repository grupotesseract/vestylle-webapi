@component('mail::message')
# Mensagem recebida pelo formulario de Fale Conosco

Usuário: {{ $pessoa ? $pessoa->nome : 'Não estava logado'}}

Nome: {{ $nome }}

Contato: {{ $contato }}

Assunto: {{ $assunto }}

Mensagem: {{ $mensagem }}
@endcomponent
