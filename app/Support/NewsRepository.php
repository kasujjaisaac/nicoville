<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsRepository
{
    private const FILE = 'news-posts.json';

    public function all(): array
    {
        if (Storage::disk('local')->exists(self::FILE)) {
            $posts = json_decode(Storage::disk('local')->get(self::FILE), true);

            if (is_array($posts)) {
                return $this->normalize($posts);
            }
        }

        return $this->defaults();
    }

    public function save(array $posts): void
    {
        Storage::disk('local')->put(self::FILE, json_encode($this->normalize($posts), JSON_PRETTY_PRINT));
    }

    public function defaults(): array
    {
        return [
            [
                'slug' => 'scholastic-support-preparing-children-for-school',
                'category' => 'Education',
                'date' => 'July 12, 2026',
                'title' => 'Scholastic Support Preparing Children for School',
                'summary' => 'A look at how books, uniforms, mentorship, and school essentials help children return to class with confidence.',
                'image' => '/uploads/slides/slide-69f548425c5674.33784962.jpg',
                'link_label' => 'Read More',
                'details' => [
                    'Scholastic materials are often the difference between a child staying in school and silently dropping out. This update shares how basic school essentials can restore confidence and regular attendance.',
                    'Through community support, Nicoville helps vulnerable learners receive books, uniforms, pens, sanitary support, and mentorship so they can return to class prepared.',
                ],
            ],
            [
                'slug' => 'food-packs-bringing-relief-to-vulnerable-families',
                'category' => 'Nutrition',
                'date' => 'August 3, 2026',
                'title' => 'Food Packs Bringing Relief to Vulnerable Families',
                'summary' => 'Our food and nutrition support gives caregivers room to breathe while children receive practical care.',
                'image' => '/uploads/slides/slide-69f5475f47f707.80354709.jpg',
                'link_label' => 'Read More',
                'details' => [
                    'Food support gives families room to breathe during difficult seasons. Each food pack is a practical reminder that children and caregivers are not alone.',
                    'Our nutrition outreach focuses on dignity, consistency, and follow-up conversations that help families move toward stability.',
                ],
            ],
            [
                'slug' => 'restoring-dignity-for-street-connected-children',
                'category' => 'Child Care',
                'date' => 'September 18, 2026',
                'title' => 'Restoring Dignity for Street-Connected Children',
                'summary' => 'Consistent outreach, meals, hygiene kits, and follow-up care create pathways toward safety and hope.',
                'image' => '/uploads/slides/slide-69f54850bb6117.98724716.jpeg',
                'link_label' => 'Read More',
                'details' => [
                    'Street-connected children need more than one-time support. They need safe contact, trust, meals, hygiene support, and careful follow-up.',
                    'Nicoville’s outreach work creates pathways toward dignity, protection, counseling referrals, and reintegration where possible.',
                ],
            ],
        ];
    }

    public function find(string $slug): ?array
    {
        foreach ($this->all() as $post) {
            if ($post['slug'] === $slug) {
                return $post;
            }
        }

        return null;
    }

    private function normalize(array $posts): array
    {
        return collect($posts)
            ->map(function (array $post): array {
                $title = $post['title'] ?? 'News Update';
                $slug = $post['slug'] ?? Str::slug($title);

                return [
                    'slug' => $slug !== '' ? $slug : Str::random(8),
                    'category' => $post['category'] ?? 'News',
                    'date' => $post['date'] ?? '',
                    'title' => $title,
                    'summary' => $post['summary'] ?? '',
                    'image' => $post['image'] ?? '',
                    'link_label' => $post['link_label'] ?? 'Read More',
                    'link_url' => '/news/'.($slug !== '' ? $slug : Str::slug($title)),
                    'details' => collect($post['details'] ?? [$post['summary'] ?? ''])
                        ->filter()
                        ->values()
                        ->all(),
                ];
            })
            ->values()
            ->all();
    }
}
