# Verificação Cross-site request forgery (CSRF)

-   [**Sobre o middleware**](#about-middleware-csrf)
-   [O que é CSRF?](#about-csrf)
-   [Para o que utilizamos?](#utilization-csrf)
-   [Como utilizar nesta aplicação](#how-to-use-csrf)

<a name="about-csrf"></a>

## O que é CSRF?

CSRF `(Cross-Site Request Forgery)` é um tipo de ataque em que um usuário autenticado em um site é induzido, de forma maliciosa, a executar ações indesejadas em outro site onde ele já está logado. Basicamente, o ataque **ocorre quando um invasor aproveita a sessão de um usuário legítimo** para realizar ações como alterar configurações de conta, enviar formulários ou realizar transações sem o consentimento da vítima.

<a name="utilization-csrf"></a>

## Para o que utilizamos o CSRF?

O CSRF middleware é utilizado em aplicações web para proteger contra ataques de **Cross-Site Request Forgery (CSRF)**, No Laravel, o `CSRF middleware` é usado para proteger rotas que manipulam dados, como **POST, PUT, PATCH e DELETE**, garantindo que a requisição veio do próprio usuário autenticado. O middleware verifica se um token CSRF válido foi incluído na requisição. Esse token é gerado automaticamente pelo framework e pode ser inserido em formulários usando o helper **@csrf**. Se o token não for válido ou estiver ausente, a requisição será rejeitada, prevenindo ataques maliciosos.

<a name="how-to-use-csrf"></a>

## Como utilizar o CSRF nesta aplicação

### Ativação do middleware

- Para ativar o CSRF você precisa atualizar seu arquivo `@/routes/api.php` adicionando o middleware **web** para utilização do CSRF.
- Após isto apenas atualize sua *allowed_origins* em seu arquivo `@/config/cors.php` adicionando sua rota de Front End.
- **Lembrete**: *Para utilizar o CSRF você precisa que a conexão entre back end e front end estejam no máximo em 2 subdominios diferentes, só assim os cookies de sessão irão funcionar.*

### Utilizando CSRF

A autenticação é realizada via CSRF tokens. Para todas as rotas protegidas devem ser enviadas em seus cabeçalhos o parâmetro:

### Body Rules

```json
{
    "X-XSRF-TOKEN": "XSRF-TOKEN-{...cookieToken}"
}
```

### Endpoint de exemplo (registrar usuário)

No processo de login de um novo usuário, o serviço **CSRF valida o token de segurança do formulário**. Se o token for válido, as validações de dados são aplicadas e o usuário é logado no banco de dados, garantindo proteção contra ataques CSRF.

| Method |   URL    |        Headers        |
| :----: | :------: | --------------------  |
|  POST  | `/login` |  X-XSRF-TOKEN & Auth  |

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

> {danger.fa-times-circle-o} CSRF enviado de forma inválida

Código `419`

```md
419 | PAGE EXPIRED
```

> {danger.fa-times-circle-o} E-mail ou senha invalido!

Código `422`

```json
{
    "success": "boolean",
    "message": "string"
}
```
