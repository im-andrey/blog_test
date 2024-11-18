<?php

namespace App\Http\Controllers;

use App\Http\Resources\Article\ArticleResource;
use App\Http\Resources\Tag\TagResource;
use App\Models\Article;
use App\Models\Tag;
use App\Services\ArticleService;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    private ArticleService $articleService;

    public function __construct(ArticleService $articleService) {
        $this->articleService = $articleService;
    }

    public function index(Request $request)
    {
        $sessionId = $request->session()->getId();

        $tag = $request->query('tag');

        $articles = $this->articleService->getArticles($tag, $sessionId);

        return inertia('Articles/Index', [
            'articles' => ArticleResource::collection($articles)->resolve(),
            'pagination' => $articles->toArray()['links'],
            'tags' => TagResource::collection(Tag::all())->resolve(),
            'currentTag' => $tag ? (int) $tag : null
        ]);
    }

    public function show(Request $request, $slug) {
        $sessionId = $request->session()->getId();

        $article = $this->articleService->getArticleBySlug($slug, $sessionId);

        return inertia('Articles/Show', ['article' => $article]);
    }

    public function incrementViews(Request $request, $id) {
        $article = Article::findOrFail($id);

        $article->increment('views');

        return response()->json(['message' => 'Просмотры увеличены.']);
    }
}
