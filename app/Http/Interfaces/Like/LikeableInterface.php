<?php

namespace App\Http\Interfaces\Like;

use Illuminate\Database\Eloquent\Relations\HasMany;

// Например, если будем расширять функционал и захотим чтобы комменты тоже были лайкаемыми
interface LikeableInterface {
    public function likes(): HasMany;
    public function getLikesCount(): int;
    public function isLikedBySession(string $sessionId): bool;
    public function isLikedByUser(int $userId): bool;
}
