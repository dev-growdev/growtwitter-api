<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    protected $cacheDuration = 5;

    protected $cacheKey = 'posts_index';

    public function index()
    {
        $posts = Cache::remember($this->cacheKey, $this->cacheDuration, function () {
            return Post::with([
                'user:id,username,name,avatar_url',
                'likes',
                'retweets',
                'comments' => function ($query) {
                    $query->with('user'); // carregar o usuário que fez o comentário
                }
            ])
                ->withCount('likes', 'comments')
                ->latest()->get();
        });


        return response()->json(['success' => true, 'data' => $posts]);
    }

    public function store(Request $request)
    {
        try {
            $user = Auth::user();

            $request->validate(
                [
                    'content' => 'required'
                ],
                [
                    'required' => 'O campo :attribute é obrigatório.'
                ]
            );

            $post = Post::create([
                "userId" => $user->id,
                "content" => $request->content
            ]);


            Cache::forget($this->cacheKey);

            return response()->json(['success' => true, 'msg' => 'Post cadastrado com sucesso!', 'data' => $post], 201);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'msg' => $th->getMessage()], 422);
        }
    }

    public function show(int $id)
    {
        try {
            $posts = Post::with(['user:id,username,name,avatar_url', 'likes', 'retweets'])
                ->withCount('likes')
                ->where('userId', $id)
                ->latest()
                ->get();

            return response()->json(['success' => true, 'data' => $posts]);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'msg' => $th->getMessage()], 400);
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $post = Post::findOrFail($id);

            $request->validate(
                [
                    'content' => 'required'
                ],
                [
                    'required' => 'Faltou :attribute'
                ]
            );

            $post->content = $request->content;
            $post->save();


            Cache::forget($this->cacheKey);

            return response()->json(['success' => true, 'msg' => 'Post editado com sucesso!', 'data' => $post]);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'msg' => $th->getMessage()], 400);
        }
    }

    public function destroy(string $id)
    {

        try {
            $authUserId = auth()->user()->id;
            $tweet = Post::where('id', $id)->first();

            if ($tweet) {
                if ($authUserId === $tweet->userId) {
                    $tweet->delete();
                    Cache::forget($this->cacheKey);
                    return response()->json(['msg' => "Retweet $tweet->id excluído"], 200);
                } else {
                    return response()->json(['msg' => "Esse tweet não é seu, seu jaguara"], 400);
                }
            }
        } catch (\Throwable $e) {
            return response()->json(['msg' => $e->getMessage(), 400]);
        }
    }

    public function wordFrequency()
    {
        $tweets = Post::where('created_at', '>=', Carbon::now()->subDay())->get();
        $words = [];

        foreach ($tweets as $tweet) {
            $content = strtolower($tweet->content);
            $content = preg_replace('/[^a-z0-9 ]/', '', $content);
            $contentWords = explode(' ', $content);

            foreach ($contentWords as $word) {
                if (strlen($word) >= 4) {
                    if (!array_key_exists($word, $words)) {
                        $words[$word] = [
                            'count' => 1,
                            'first_occurrence' => $tweet->created_at->format('Y-m-d\TH:i:s.u\Z')
                        ];
                    } else {
                        $words[$word]['count']++;
                    }
                }
            }
        }

        arsort($words);
        $topWords = array_slice($words, 0, 10, true);

        $result = [];
        foreach ($topWords as $word => $data) {
            $result[$word] = [
                'count' => $data['count'],
                'first_occurrence' => $data['first_occurrence']
            ];
        }

        return response()->json($result);
    }

}
