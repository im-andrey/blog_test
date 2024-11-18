<?php
namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ArticleFactory extends Factory {
    protected $model = Article::class;

    public function definition()
    {
        // Заголовок
        $title = $this->faker->sentence;

        return [
            'title' => $title,
            'body' => $this->generateHtmlBody(500), // Генерация текста на 500 символов
            'views' => $this->faker->numberBetween(221, 552),
            'slug' => Str::slug($title),
            'image' => "/image",
        ];
    }

    /**
     * Генерация HTML-текста с заданным количеством символов
     */
    private function generateHtmlBody(int $length)
    {
        $text = $this->faker->text($length); // Генерируем текст заданной длины
        $paragraphs = explode("\n", wordwrap($text, $length / 3, "\n")); // Разбиваем на 3 абзаца

        // Оборачиваем каждый абзац в <p>...</p>
        return collect($paragraphs)->map(fn($p) => "<p>{$p}</p>")->join("\n");
    }
}
