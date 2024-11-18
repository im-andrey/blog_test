<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke(Request $request) {
        $sessionId = $request->session()->getId();

        $articles = Article::with('tags')
            ->withCount('likes')
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();

        $articles->each(function ($article) use ($sessionId) {
            $article->liked_by_session = $article->isLikedBySession($sessionId);
        });

        return inertia('Home', [
            'articles' => \App\Http\Resources\Article\ArticleResource::collection($articles)->resolve()
        ]);
    }
}
