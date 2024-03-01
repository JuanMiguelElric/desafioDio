<x-mail::message>
# Olá!

{{$name}} Clique no botão abaixo para verificar seu e-mail.

<x-mail::button :url="$url">
Verifique seu e-mail
</x-mail::button>
Se você não criou sua conta, nenhuma ação é necessária. <br>
Thanks,<br>
{{ config('app.name') }}

<x-mail::panel>
</x-mail::panel>
If you're having trouble clicking the "Verify Email Address" button, copy and paste the URL below into your web browser:{{$url}}
</x-mail::message>
