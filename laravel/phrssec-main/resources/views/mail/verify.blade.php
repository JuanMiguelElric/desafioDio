<x-mail::message>
# Olá!

{{$name}} Clique no botão abaixo para verificar seu e-mail.

<x-mail::button :url="$url">
Verifique seu e-mail
</x-mail::button>

Se você não criou sua conta, nenhuma ação é necessária.

Obrigado,<br>
{{ config('app.name') }}
</x-mail::message>