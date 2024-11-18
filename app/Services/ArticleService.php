<?php

namespace App\Services;

use App\Models\Article;

class ArticleService {
    public function getArticles(string|null $tag, string $sessionId): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $articlesQ = Article::query();

        if ($tag) {
            $articlesQ->whereHas('tags', function ($query) use ($tag) {
                $query->where('id', $tag);
            });
        }

        $articles = $articlesQ->with('tags')
            ->withCount('likes')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $articles->getCollection()->each(function ($article) use ($sessionId) {
            $article->liked_by_session = $article->isLikedBySession($sessionId);
        });

        return $articles;
    }

    public function getArticleBySlug(string $slug, string $sessionId)
    {
        $article = Article::where('slug', $slug)
            ->with(['comments' => fn($query) => $query->orderBy('created_at', 'desc'), 'tags'])
            ->withCount('likes')
            ->firstOrFail();

        $article->liked_by_me = $article->isLikedBySession($sessionId);

        return $article;
    }
}
