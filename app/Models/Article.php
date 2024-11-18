<?php

namespace App\Models;

use App\Http\Interfaces\Like\LikeableInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model implements LikeableInterface
{
    use HasFactory;

    protected $fillable = ['title', 'body', 'views', 'slug', 'image'];
    public function tags(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany('App\Models\Tag');
    }

    public function comments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function likes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\Like');
    }

    public function getLikesCount(): int
    {
        return $this->likes()->count();
    }

    public function isLikedBySession(string $sessionId): bool
    {
        return $this->likes()->where('session_id', $sessionId)->exists();
    }

    public function isLikedByUser(int $userId): bool
    {
        // Если добавим юзеров
        return $this->likes()->where('user_id', $userId)->exists();
    }
}
