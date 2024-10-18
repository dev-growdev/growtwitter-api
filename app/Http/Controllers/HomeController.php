<?php

namespace App\Http\Controllers;

use App\Models\Follower;
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
                $query->with('user');
            }
        ])
            ->withCount('likes', 'comments')

            ->with(['user' => function ($query) {
                $query->with(['followers', 'followings']);
            }])

            ->latest()->paginate(20);

        $retweets = Retweet::with([
            'user',
            'post' => function ($query) {
                $query->with([
                    'user:id,username,name,avatar_url',
                    'likes',
                    'retweets',
                    'comments' => function ($query) {
                        $query->with('user');
                    }
                ])->withCount('likes', 'comments');

            }
        ])

        ->with(['user' => function ($query) {
            $query->with(['followers', 'followings']);
        }])

        ->latest()->paginate(20);

        return response()->json([
            'success' => true,
            'data' => [
                'posts' => $posts,
                'retweets' => $retweets
            ]
        ]);
    }
}
