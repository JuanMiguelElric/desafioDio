<x-mail::message>
<div class="email-container">

# Novo Usuário Registrado

{{$nome}} seu usuário foi registrado com sucesso. Abaixo estão as informações do seu usuário:
    
    
- **Email:** {{$email}}
- **Senha:** {{$password}} **(Altere sua senha segura)**
<x-mail::button :url="$url" class="bg-primary">
    Entrar
</x-mail::button>

Obrigado,<br>
{{ config('app.name') }}
</div>
</x-mail::message>
