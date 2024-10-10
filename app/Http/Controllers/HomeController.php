<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Retweet;


class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::with([
            'user:id,username,name,avatar_url',
            'likes',
            'retweets',
            'comments' => function ($query) {
                $query->with('user'); // carregar o usuário que fez o comentário
            }
        ])
            ->withCount('likes', 'comments')
            ->latest()->paginate(20);


        $retweets = Retweet::with(['user', 'post'])->latest()->paginate(20);
        return response()->json([
            'success' => true,
            'data' => [
                'posts' => $posts,
                'retweets' => $retweets
            ]
        ]);
    }
}
