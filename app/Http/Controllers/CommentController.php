<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Article;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request, Article $article) {
        $validated = $request->validated();

        $comment = new Comment([
            'subject' => $validated['subject'],
            'body' => $validated['body'],
            'article_id' => $article->id
        ]);
        sleep(3);
        $comment->save();

        return response()->json([
            "message" => 'Комментарий успешно добавлен!',
            "comment" => $comment
        ], 201);
    }
}
