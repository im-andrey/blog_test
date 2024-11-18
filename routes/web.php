<?php

use App\Http\Controllers\ProfileController;
use App\Models\Article;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', App\Http\Controllers\HomeController::class)->name('home');

Route::get('/articles', [App\Http\Controllers\ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{id}', [App\Http\Controllers\ArticleController::class, 'show'])->name('articles.show');

Route::post('/articles/{article}/like', [App\Http\Controllers\LikeController::class, 'toggleArticleLike'])->name('articles.toggleLike');

Route::post('/articles/{article}/comment', [App\Http\Controllers\CommentController::class, 'store'])->name('comments.store');

// Добавил кастомный middleware для контроля количества попыток постучаться пользователю в этот запрос
// В данной конфигурации в контексте сессии пользователю будет доступно 5 запросов в минуту
Route::post('/articles/{id}/increment-views', [App\Http\Controllers\ArticleController::class, 'incrementViews'])
    ->middleware('throttle.article.views:5,1')
    ->name('articles.incrementViews');
