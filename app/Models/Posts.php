<?php

namespace App\Models;

use Illuminate\Support\Str;

class Posts
{
    private static array $posts = [
        [
            'id' => 1,
            'slug' => 'first-post',
            'title' => 'First Post',
            'text' => 'Some post text.'
        ],
        [
            'id' => 2,
            'slug' => 'second-post',
            'title' => 'Second Post',
            'text' => 'Some post text.'
        ],
        [
            'id' => 3,
            'slug' => 'third-post',
            'title' => 'Third Post',
            'text' => 'Some post text.'
        ]
    ];

    public static function getPosts(): array
    {
        return self::$posts;
    }

    public static function getPost(string $slug): ?array
    {
        foreach (self::$posts as $post) {
            if ($post['slug'] === $slug) {
                return $post;
            }
        }
        return null;
    }

    public static function addPost(string $title, string $text): void
    {
        self::$posts[] = [
            'id' => count(self::$posts) + 1,
            'slug' => Str::slug($title),
            'title' => $title,
            'text' => $text
        ];
    }
}

