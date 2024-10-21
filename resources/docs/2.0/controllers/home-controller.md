# Home

- [Home](#home)
  - [Definindo estruturas](#definindo-estruturas)
    - [Objeto User](#objeto-user)
    - [Objeto Likes](#objeto-likes)
    - [Objeto Retweets](#objeto-retweets)
    - [Objeto Comments](#objeto-comments)
  - [Pegar todos os posts](#pegar-todos-os-posts)
    - [Endpoint (Pegar posts)](#endpoint-pegar-posts)
    - [Responses](#responses)

<a name="definindo-estruturas"></a>

## Definindo estruturas

Para explicar certamente cada parte das novas controllers aqui vai um guia para não termos apenas um grande objeto como retorno e sem explicação.

Sempre que houver algum destes objetos no retorno exemplo: `"user":{ ... }`. Assimile estes tipos:

<a name="objeto-user"></a>

### Objeto User

```json
"user": {
    "id": "number",
    "name": "string",
    "surname": "string",
    "email": "string",
    "username": "string",
    "avatar_url": "string|null",
    "cover_url": "string|null",
    "email_verified_at": "string|null",
    "created_at": "string|date",
    "updated_at": "string|date",
    "followers": [
        {
            "id": "number",
            "created_at": "string|date",
            "updated_at": "string|date",
            "followingId": "number",
            "followerId": "number"
        }
    ],
    "followings": [
        {
            "id": "number",
            "created_at": "string|date",
            "updated_at": "string|date",
            "followingId": "number",
            "followerId": "number"
        }
    ]
},
```

<a name="objeto-likes"></a>

### Objeto Likes

```json
"likes": [
        {
            "id": "number",
            "userId": "number",
            "postId": "number",
            "created_at": "string|date",
            "updated_at": "string|date"
        }
    ]
```

<a name="objeto-retweets"></a>

### Objeto Retweets

```json
"retweets": [
    {
        "id": "number",
        "userId": "number",
        "postId": "number",
        "created_at": "string|date",
        "updated_at": "string|date"
    }
]
```

<a name="objeto-comments"></a>

### Objeto Comments

```json
"comments": [
    {
        "id": "number",
        "userId": "number",
        "postId": "number",
        "content": "string",
        "created_at": "string|date",
        "updated_at": "string|date",
        "user": {
            "id": "number",
            "name": "string",
            "surname": "string",
            "email": "string",
            "username": "string",
            "avatar_url": "string|null",
            "cover_url": "string|null",
            "email_verified_at": "string|null",
            "created_at": "string|date",
            "updated_at": "string|date"
        }
    }
]
```

<a name="pegar-todos-os-posts" />

## Pegar todos os posts

Este método pega todos os posts dos usuários com suas relações.

<a name="endpoint-pegar-posts" />

### Endpoint (Pegar posts)

Para pegar todos os posts e retweets, comentários e curtidas com seus usuários, enviar request conforme dados exemplificados abaixo.

| Method |   URL   | Headers |
| :----: | :-----: | :-----: |
|  GET   | `/home` |  Auth   |

<a name="responses" />

### Responses

> {success.fa-check-circle-o} Usuário está autenticado e tem permissão para acessar este recurso

Código `200`

```json
{
    "success": "boolean",
    "data": {
        "posts": {
            "current_page": "number",
            "data": [
                {
                    "id": "number",
                    "content": "string",
                    "userId": "number",
                    "created_at": "string|date",
                    "updated_at": "string|date",
                    "likes_count": "number",
                    "comments_count": "number",
                    "user": { ... },
                    "likes": [{ ... }],
                    "retweets": [{ ... }],
                    "comments": [{ ... }],
                }
            ],
            "first_page_url": "string",
            "from": "number",
            "last_page": "number",
            "last_page_url": "string",
            "links": [
                {
                    "url": "string|null",
                    "label": "string",
                    "active": "boolean"
                }
            ],
            "next_page_url": "string|null",
            "path": "string",
            "per_page": "number",
            "prev_page_url": "string|null",
            "to": "number",
            "total": "number"
        },
        "retweets": {
            "current_page": "number",
            "data": [
                {
                    "id": "number",
                    "content": "string",
                    "userId": "number",
                    "created_at": "string|date",
                    "updated_at": "string|date",
                    "likes_count": "number",
                    "comments_count": "number",
                    "user": { ... },
                    "post": {
                        "id": "number",
                        "content": "string",
                        "userId": "number",
                        "created_at": "string|date",
                        "updated_at": "string|date",
                        "likes_count": "number",
                        "comments_count": "number",
                        "user": {
                            "id": "number",
                            "username": "string",
                            "name": "string",
                            "avatar_url": "string|null"
                        },
                    "likes": [{ ... }],
                    "retweets": [{ ... }],
                    "comments": [{ ... }],
                    }
                }
            ],
            "first_page_url": "string",
            "from": "number",
            "last_page": "number",
            "last_page_url": "string",
            "links": [
                {
                    "url": "string|null",
                    "label": "string",
                    "active": "boolean"
                }
            ],
            "next_page_url": "string|null",
            "path": "string",
            "per_page": "number",
            "prev_page_url": "string|null",
            "to": "number",
            "total": "number"
        }
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
