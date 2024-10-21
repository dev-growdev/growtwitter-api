# Introdução

---

- [Introdução](#introdução)
  - [Boas-vindas](#boas-vindas)
  - [Funcionamento dos Controllers](#funcionamento-dos-controllers)
  - [Responses](#responses)

<a name="boas-vindas"></a>

## Boas-vindas

Seja bem-vindo à documentação oficial da API do **GrowTwitter 2.0**! Esta API te permitirá criar um clone funcional do Twitter, fornecendo as rotas, parâmetros e retornos necessários para construir uma experiência completa.

<a name="funcionamento-controllers"></a>

## Funcionamento dos Controllers

Os controllers são o coração da API, responsáveis por gerenciar as operações relacionadas às funcionalidades da aplicação. Por exemplo, o controller de **Posts** controla todas as ações sobre as postagens dos usuários, incluindo criar, visualizar, editar e excluir posts. Também lida com interações como curtidas, retweets e comentários.

Aqui estão os principais métodos oferecidos pelo controller de Posts:

-   **Listar posts:** Retorna todos os posts com suas relações (curtidas, retweets, comentários).
-   **Exibir post:** Recupera um post específico pelo ID.
-   **Criar post:** Permite criar uma nova postagem.
-   **Editar post:** Atualiza uma postagem existente.
-   **Excluir post:** Remove um post permanentemente.

Todos os endpoints requerem autenticação via header `Auth`, garantindo que apenas usuários autenticados possam interagir com os recursos.

<a name="responses"></a>

## Responses

Exemplo de retorno positivo:

> {success.fa-check-circle-o} Usuário autenticado e autorizado para acessar este recurso

Código `200`

```json
{
    "success": "boolean",
    "data": [
        {
            "id": "number",
            "content": "string",
            "userId": "number",
            "created_at": "string|date",
            "updated_at": "string|date",
            "likes_count": "number",
            "user": {
                "id": "number",
                "username": "string",
                "name": "string",
                "avatar_url": "string|null"
            },
            "likes": [
                {
                    "id": "number",
                    "userId": "number",
                    "postId": "number",
                    "created_at": "string|date",
                    "updated_at": "string|date"
                }
            ],
            "retweets": [
                {
                    "id": "number",
                    "userId": "number",
                    "postId": "number",
                    "content": "number",
                    "created_at": "string|date",
                    "updated_at": "string|date"
                }
            ]
        }
    ]
}
```

Exemplo de retorno negativo:

> {danger.fa-times-circle-o} Usuário não autenticado

```json
{
    "success": false,
    "message": "Usuário não autenticado"
}
```
