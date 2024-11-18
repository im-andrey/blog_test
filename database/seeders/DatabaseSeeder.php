<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Like;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $articles = Article::factory()->count(27)->create();

        Like::factory()->count(1320)->create();

        $customTags = [
            'Технологии',
            'Здоровье',
            'Образование',
            'Спорт',
            'Бизнес',
            'Экология'
        ];

        $tags = collect();
        foreach ($customTags as $tagName) {
            $tags->push(
                Tag::factory()->create(['name' => $tagName])
            );
        }

        $articles->each(function ($article) use ($tags) {
            $randomTags = $tags->random(rand(1, 3));

            $randomTags->each(function ($tag) use ($article) {
                $article->tags()->attach($tag->id);
            });
        });


    }
}
