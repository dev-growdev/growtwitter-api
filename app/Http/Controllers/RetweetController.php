<?php

namespace App\Http\Controllers;

use App\Models\Retweet;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RetweetController extends Controller
{

    public function index()
    {
        $retweet = Retweet::with(["user", "post"])->latest()->get();
        return response()->json(['success' => true, 'data' => $retweet]);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            "postId" => "required",
            "content" => "nullable"
        ]);

        $retweet = Retweet::create([
            "userId" => $user->id,
            "postId" => $request->postId,
            "content" => $request->content
        ]);
        return response()->json(['success' => true, 'msg' => 'Retweetado com sucesso!', 'data' => $retweet], 201);

    }

    public function show(Retweet $retweet)
    {
        //
    }

    public function update(Request $request, Retweet $retweet)
    {
        //
    }

    public function destroy(Request $id)
    {
        try {
            $retweet = Retweet::findOrFail($id);
            $retweet->delete();


            return response()->json(['success' => true, 'msg' => 'Retweet nº ' . $id . ' excluído com sucesso!']);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'msg' => $th->getMessage()], 400);
        }
    }
}
