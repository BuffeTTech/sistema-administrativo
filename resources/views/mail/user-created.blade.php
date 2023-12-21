<x-mail::message>
# Usuário criado com sucesso!

<p>Criação de {{$user_type}}</p>

<p>Senha: {{$password}}</p>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
