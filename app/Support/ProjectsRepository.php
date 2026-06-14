<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectsRepository
{
    private const FILE = 'projects.json';

    public function all(): array
    {
        if (Storage::disk('local')->exists(self::FILE)) {
            $projects = json_decode(Storage::disk('local')->get(self::FILE), true);

            if (is_array($projects)) {
                return $this->normalize($projects);
            }
        }

        return $this->defaults();
    }

    public function save(array $projects): void
    {
        Storage::disk('local')->put(self::FILE, json_encode($this->normalize($projects), JSON_PRETTY_PRINT));
    }

    public function find(string $slug): ?array
    {
        foreach ($this->all() as $project) {
            if ($project['slug'] === $slug) {
                return $project;
            }
        }

        return null;
    }

    public function defaults(): array
    {
        return [
            [
                'slug' => 'pad-the-girl-project',
                'title' => 'Pad The Girl Project',
                'category' => 'Girls Education',
                'status' => 'Ongoing',
                'started' => '2019',
                'image' => '/uploads/slides/slide-69f548425c5674.33784962.jpg',
                'gallery' => [
                    '/uploads/slides/slide-69f548425c5674.33784962.jpg',
                    '/uploads/slides/slide-69f595fc4cf447.08726991.jpg',
                    '/uploads/slides/slide-69f5475f47f707.80354709.jpg',
                ],
                'summary' => 'Restoring dignity, confidence, health, and educational opportunities for vulnerable girls through sanitary pad support and menstrual health education.',
                'stats' => [
                    ['number' => '2,000+', 'label' => 'Girls reached'],
                    ['number' => '2019', 'label' => 'Year started'],
                    ['number' => '10,000+', 'label' => 'Future target'],
                ],
                'sections' => [],
                'closing_title' => '',
                'report_file' => '',
            ],
        ];
    }

    private function normalize(array $projects): array
    {
        $usedSlugs = [];

        return collect($projects)
            ->map(function (array $project) use (&$usedSlugs): array {
                $title = trim((string) ($project['title'] ?? 'Project'));
                $slug = Str::slug($project['slug'] ?? $title);
                $slug = $slug !== '' ? $slug : Str::random(8);
                $baseSlug = $slug;
                $suffix = 2;

                while (in_array($slug, $usedSlugs, true)) {
                    $slug = "{$baseSlug}-{$suffix}";
                    $suffix++;
                }

                $usedSlugs[] = $slug;

                return [
                    'slug' => $slug,
                    'title' => $title,
                    'category' => trim((string) ($project['category'] ?? 'Project')),
                    'status' => trim((string) ($project['status'] ?? 'Ongoing')),
                    'started' => trim((string) ($project['started'] ?? '')),
                    'image' => trim((string) ($project['image'] ?? '')),
                    'gallery' => collect($project['gallery'] ?? [])
                        ->map(fn ($image): string => trim((string) $image))
                        ->filter()
                        ->values()
                        ->all(),
                    'summary' => trim((string) ($project['summary'] ?? '')),
                    'stats' => collect($project['stats'] ?? [])
                        ->map(fn (array $stat): array => [
                            'number' => trim((string) ($stat['number'] ?? '')),
                            'label' => trim((string) ($stat['label'] ?? '')),
                        ])
                        ->filter(fn (array $stat): bool => $stat['number'] !== '' || $stat['label'] !== '')
                        ->values()
                        ->all(),
                    'sections' => collect($project['sections'] ?? [])
                        ->map(fn (array $section): array => [
                            'title' => trim((string) ($section['title'] ?? 'Project Section')),
                            'body' => collect($section['body'] ?? [])
                                ->map(fn ($paragraph): string => trim((string) $paragraph))
                                ->filter()
                                ->values()
                                ->all(),
                        ])
                        ->filter(fn (array $section): bool => $section['title'] !== '' || ! empty($section['body']))
                        ->values()
                        ->all(),
                    'closing_title' => trim((string) ($project['closing_title'] ?? '')),
                    'report_file' => trim((string) ($project['report_file'] ?? '')),
                ];
            })
            ->filter(fn (array $project): bool => $project['title'] !== '')
            ->values()
            ->all();
    }
}
