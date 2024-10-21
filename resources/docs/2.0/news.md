# Novidades da Aplicação

-   [**Verificação Cross-site request forgery (CSRF)**](#about-csrf)
-   [**Rate Limiter**](#about-rate-limiter)
-   [**Home Controller**](#about-home-controller)
-   [**Profile Controller**](#about-profile-controller)

<a name="about-csrf"></a>

## Verificação Cross-site request forgery (CSRF)

CSRF `(Cross-Site Request Forgery)` é um tipo de ataque em que um usuário autenticado em um site é induzido, de forma maliciosa, a executar ações indesejadas em outro site onde ele já está logado. Para proteger a aplicação, o middleware CSRF deve ser utilizado.

### Como utilizar o CSRF nesta aplicação

-   Para ativar o CSRF, você precisa atualizar seu arquivo `@/routes/api.php` adicionando o middleware **web**. Depois, atualize sua _allowed_origins_ em `@/config/cors.php`.
-   A autenticação é realizada via CSRF tokens e deve ser enviada em todos os cabeçalhos das rotas protegidas.

### Exemplo de Endpoint

| Method |   URL    | Headers             |
| :----: | :------: | ------------------- |
|  POST  | `/login` | X-XSRF-TOKEN & Auth |

#### Body Rules

```json
{
    "email": "required|email",
    "password": "required"
}
```

### Responses

> {success.fa-check-circle-o} Login bem-sucedido

`Código 200`

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

`Código 419`

```md
419 | PAGE EXPIRED
```

> {danger.fa-times-circle-o} E-mail ou senha inválido!

`Código 422`

```json
{
    "success": "boolean",
    "message": "string"
}
```

<a name="about-rate-limiter"></a>

## Rate Limiter

O `Rate Limiter` é um mecanismo utilizado para limitar o número de requisições que um cliente pode fazer a uma API em um determinado período de tempo. Isso é importante para proteger a aplicação contra abusos, como ataques de força bruta ou sobrecarga de servidores.

## Como utilizar o Rate Limiter nesta aplicação

-   Para implementar o rate limiter no Laravel, você pode usar o middleware `ThrottleRequests`. Isso pode ser configurado no arquivo de rotas `@/routes/api.php`.
-   Você pode definir limites globais ou por usuário, especificando o número máximo de requisições permitidas em um intervalo de tempo.

### Responses

> {danger.fa-times-circle-o} CSRF enviado de forma inválida

`Código 429`

```json
{
    "success": "boolean",
    "message": "string"
}
```

<a name="about-home-controller" />

## Home Controller

O `Home Controller` é responsável por gerenciar as requisições relacionadas à página inicial da aplicação. Ele serve como um ponto de entrada para os usuários acessarem informações gerais e funcionalidades da aplicação.

## O que a Home Controller faz

-   **Mostrar a Página Inicial**: Retorna a visualização da página inicial com informações relevantes.
-   **Buscar Posts**: Fornece uma lista de posts para exibição na página inicial.
-   **Contar Seguidores e Seguindo**: Recupera informações sobre o número de seguidores e contas que o usuário está seguindo.

<a name="about-profile-controller" />

## Profile Controller

O `Profile Controller` é responsável por gerenciar todas as operações relacionadas ao perfil do usuário na aplicação. Isso inclui a visualização, atualização e recuperação de informações do perfil do usuário.

## O que a Profile Controller faz

-   **Visualizar Posts**: Permite que um usuário visualize seus posts e retweets.
-   **Listar Seguidores**: Recupera a lista de seguidores do usuário.
-   **Listar Seguindo**: Recupera a lista de usuários que o usuário está seguindo.
