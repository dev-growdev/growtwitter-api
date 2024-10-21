# Verificação Cross-site request forgery (CSRF)

-   [**Sobre o middleware**](#about-middleware-rate-limit)
-   [O que é Rate Limiter?](#about-rate-limit)
-   [Utilizando Rate Limiter](#using-rate-limit)

<a name="about-rate-limit"></a>

## O que é Rate Limiter?

Um **rate limiter** controla o número de requisições que um cliente pode fazer a um servidor em um período de tempo, prevenindo abusos e sobrecarga. Se o limite for excedido, o cliente é bloqueado temporariamente ou recebe um erro `(429 Too Many Requests)`. Ele melhora a segurança contra ataques e garante a estabilidade do servidor. Exemplos de utilização:

-   Prevenir abusos, como ataques de força bruta ou DDoS.
-   Proteger os recursos do servidor, evitando sobrecarga.
-   Garantir a estabilidade e desempenho do sistema para todos os usuários.
-   Distribuir recursos de forma justa, impedindo que um único cliente monopolize o serviço.

<a name="using-rate-limit"></a>

## Utilizando Rate Limiter nesta aplicação

### Ativação do middleware

-   Para ativar o CSRF você precisa atualizar seu arquivo `@/routes/api.php` adicionando o middleware **throttle:1**, o número 1 indica o tempo em minutos que o usuário ficará bloquado de fazer requisições.
-   **Lembrete:** _O throttle middleware utilizar o email enviado nas requests e o ip do usuário para validar suas tentativas._

### Endpoint de exemplo (registrar usuário)

No processo de login de um novo usuário, o serviço **CSRF valida o token de segurança do formulário**. Se o token for válido, as validações de dados são aplicadas e o usuário é logado no banco de dados, garantindo proteção contra ataques CSRF.

| Method |   URL    | Headers             |
| :----: | :------: | ------------------- |
|  POST  | `/login` | X-XSRF-TOKEN & Auth |

#### Body rules

```json
{
    "email": "required|email",
    "password": "required"
}
```

### Responses

> {success.fa-check-circle-o} Login bem-sucedido

Código `200`

```json
{
    "success": "boolean",
    "msg": "string",
    "data": {
        "user": {
            "id": "number",
            "name": "string",
            "surname": "string",
            "email": "string",
            "username": "string",
            "avatar_url": "string|null",
            "email_verified_at": "string|null",
            "created_at": "string|date",
            "updated_at": "string|date"
        },
        "token": "string"
    }
}
```

> {danger.fa-times-circle-o} Usuário excede o número de tentativas

Código `429`

```json
    "success": false,
    "message": "Muitas tentativas."
```

> {danger.fa-times-circle-o} E-mail ou senha invalido!

Código `422`

```json
{
    "success": "boolean",
    "message": "string"
}
```
