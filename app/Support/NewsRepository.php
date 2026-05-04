<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;

class NewsRepository
{
    private const FILE = 'news-posts.json';

    public function all(): array
    {
        if (Storage::disk('local')->exists(self::FILE)) {
            $posts = json_decode(Storage::disk('local')->get(self::FILE), true);

            if (is_array($posts)) {
                return $posts;
            }
        }

        return $this->defaults();
    }

    public function save(array $posts): void
    {
        Storage::disk('local')->put(self::FILE, json_encode(array_values($posts), JSON_PRETTY_PRINT));
    }

    public function defaults(): array
    {
        return [
            [
                'category' => 'Education',
                'date' => 'July 12, 2026',
                'title' => 'Scholastic Support Preparing Children for School',
                'summary' => 'A look at how books, uniforms, mentorship, and school essentials help children return to class with confidence.',
                'image' => '/uploads/slides/slide-69f548425c5674.33784962.jpg',
                'link_label' => 'Read More',
                'link_url' => '/contact',
            ],
            [
                'category' => 'Nutrition',
                'date' => 'August 3, 2026',
                'title' => 'Food Packs Bringing Relief to Vulnerable Families',
                'summary' => 'Our food and nutrition support gives caregivers room to breathe while children receive practical care.',
                'image' => '/uploads/slides/slide-69f5475f47f707.80354709.jpg',
                'link_label' => 'Read More',
                'link_url' => '/contact',
            ],
            [
                'category' => 'Child Care',
                'date' => 'September 18, 2026',
                'title' => 'Restoring Dignity for Street-Connected Children',
                'summary' => 'Consistent outreach, meals, hygiene kits, and follow-up care create pathways toward safety and hope.',
                'image' => '/uploads/slides/slide-69f54850bb6117.98724716.jpeg',
                'link_label' => 'Read More',
                'link_url' => '/contact',
            ],
        ];
    }
}
