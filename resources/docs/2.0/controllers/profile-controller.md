# Home

- [Home](#home)
  - [Definindo estruturas](#definindo-estruturas)
    - [Objeto User](#objeto-user)
    - [Objeto FollowerData](#objeto-followerdata)
    - [Objeto FollowingData](#objeto-followingdata)
    - [Objeto Likes](#objeto-likes)
    - [Objeto Retweets](#objeto-retweets)
    - [Objeto Comments](#objeto-comments)
  - [Pegar todos os posts do usuário](#pegar-todos-os-posts-do-usuário)
    - [Endpoint (Pegar posts do usuário)](#endpoint-pegar-posts-do-usuário)
    - [Responses](#responses)

<a name="definindo-estruturas"></a>

## Definindo estruturas

Para explicar certamente cada parte das novas controllers aqui vai um guia para não termos apenas um grande objeto como retorno e sem explicação.

Sempre que houver algum destes objetos no retorno, assimile estes tipos:

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
    "posts_count": "number",
    "retweets_count": "number",
    "posts": {
            "id": "number",
            "content": "string",
            "userId": "number",
            "created_at": "string|date",
            "updated_at": "string|date"
        }
}
```

<a name="objeto-followerdata"></a>

### Objeto FollowerData

```json
"followerData": {
        "current_page": "number",
        "data": [
            {
                "id": "number",
                "created_at": "string|date",
                "updated_at": "string|date",
                "followingId": "number",
                "followerId": "number",
                "follower": {
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
                    "retweets": [
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
                            },
                            "post": {
                                "id": "number",
                                "content": "string",
                                "userId": "number",
                                "created_at": "string|date",
                                "updated_at": "string|date"
                            }
                        }
                    ]
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
```

<a name="objeto-followingdata"></a>

### Objeto FollowingData

```json
"followingsData": {
        "current_page": "number",
        "data": [
            {
                "id": "number",
                "created_at": "string|date",
                "updated_at": "string|date",
                "followingId": "number",
                "followerId": "number",
                "follower": {
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
                    "retweets": [
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
                            },
                            "post": {
                                "id": "number",
                                "content": "string",
                                "userId": "number",
                                "created_at": "string|date",
                                "updated_at": "string|date"
                            }
                        }
                    ]
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

<a name="pegar-todos-os-posts-do-usuário" />

## Pegar todos os posts do usuário

Este método pega todos os posts dos usuários com suas relações.

<a name="endpoint-pegar-posts-do-usuário" />

### Endpoint (Pegar posts do usuário)

Para pegar todos os posts e retweets, comentários e curtidas do usuário especifico, enviar request conforme dados exemplificados abaixo.

| Method |    URL     | Headers |
| :----: | :--------: | :-----: |
|  GET   | `/profile` |  Auth   |

<a name="responses" />

### Responses

> {success.fa-check-circle-o} Usuário está autenticado e tem permissão para acessar este recurso

Código `200`

```json
{
    "followings": "number",
    "followers": "number",
    "followingsData": { ... },
    "followersData": { ... },
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
```

> {danger.fa-times-circle-o} Usuário não está autenticado

Código `401`

```json
{
    "success": "boolean",
    "message": "string"
}
```
