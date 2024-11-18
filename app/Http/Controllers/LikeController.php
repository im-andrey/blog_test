<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function toggleArticleLike(Article $article) {
        $sessionId = session()->getId();

        $like = Like::where('article_id', $article->id)
            ->where('session_id', $sessionId)
            ->first();

        if ($like) {
            $like->delete();
        } else {
            try {
                Like::create([
                    'article_id' => $article->id,
                    'session_id' => $sessionId
                ]);
            } catch (\Exception $e) {
                dd($e);
            } catch (\Error $err) {
                dd($err);
            }

        }

        return response()->json(['count' => $article->getLikesCount()], 200);
    }
}
