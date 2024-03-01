<x-mail::message>

# Confirmação

**{{$student->name}}** sua senha foi alterada com sucesso.

<x-mail::button :url="$url">
Entrar
</x-mail::button>

Obrigado, <br>
{{ config('app.name') }}

</x-mail::message>