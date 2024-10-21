# Comentários

-   [**Métodos Controller**](#controller)
-   [Criar novo comentário](#new-comment)
-   [Editar comentário](#update-comment)
-   [Deletar comentário`](#delete-comment)

<a name="controller"></a>

## Cadastro de novo comentário

Este método cria um comentário.

<a name="new-comment"></a>

### Endpoint (criar comentário)

Para criar um novo comentário, enviar request conforme dados exemplificados abaixo.

| Method |   URI    | Headers |
| :----: | :------: | :-----: |
|  POST  |`/comment`|    -    |

#### Body rules

```json
{
    "postId": "required|string",
    "content": "required|string",
}
```

### Responses


> {success.fa-check-circle-o} Comentário aplicado!

Código `200`

```json
{
    "success": "boolean",
    "msg": "string",
    "data": {
       "postId": "number",
        "userId": "number",
        "content": "string",
        "updated_at": "string|date",
        "created_at": "string|date",
        "id": "number"      
    }
}
```

<a name="responses-create-comment"></a>

> {danger.fa-times-circle-o} Usuário não está autenticado

Código `401`

```json
{
    "success": "boolean",
    "message": "string"
}
```




## Alteração de comentário

Este método permite editar um comentário já existente.

<a name="update-comment"></a>

### Endpoint (update)

Para editar um comentário já existente, enviar request conforme dados exemplificados abaixo:

| Method |   URI    | Headers |
| :----: | :------: | ------- |
|  PUT   |`/comment`|

#### Body rules

```json
{
    "content": "required|string",
}
```

### Responses

> {success.fa-check-circle-o} Comentário editado!

Código `200`

```json
{
    "success": "boolean",
    "msg": "string",
    "data": {
        "id": "number",
        "userId": "number",
        "postId": "number",
        "userId": "number",
        "content": "string",
        "updated_at": "string|date",
        "created_at": "string|date",   
    }
}
```


> {danger.fa-times-circle-o} Usuário não está autenticado

Código `401`

```json
{
    "success": "boolean",
    "message": "string"
}
```

## Deletar comentário

Este método permite deletar um comentário.

<a name="delete-comment"></a>

### Endpoint (deletar comentário)

Para deletar um comentário, enviar request conforme dados exemplificados abaixo:

| Method |       URL            | Headers |
| :----: | :-----------------:  | :-----: |
| DELETE | `/comment/commentId` |  Auth   |




### Responses

> {success.fa-check-circle-o} Comentário excluído!

Código `201`

```json
{
    "success": "boolean",
    "msg": "string"
}
```

> {danger.fa-times-circle-o} Usuário não está autenticado

Código `401`

```json
{
    "success": "boolean",
    "message": "string"
}
```

