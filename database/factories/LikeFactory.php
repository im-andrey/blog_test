<?php
namespace Database\Factories;

use App\Models\Article;
use App\Models\Like;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
class LikeFactory extends Factory {
    protected $model = Like::class;

    public function definition() {

        return [
            'article_id' => Article::inRandomOrder()->first()->id,
        ];
    }
}
