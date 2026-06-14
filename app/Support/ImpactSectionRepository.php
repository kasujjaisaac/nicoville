<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;

class ImpactSectionRepository
{
    private const FILE = 'impact-section.json';

    public function __construct(private readonly HeroSliderRepository $sliders)
    {
    }

    public function get(): array
    {
        if (Storage::disk('local')->exists(self::FILE)) {
            $impact = json_decode(Storage::disk('local')->get(self::FILE), true);

            if (is_array($impact)) {
                return $this->normalize(array_replace_recursive($this->defaults(), $impact));
            }
        }

        return $this->defaults();
    }

    public function save(array $impact): void
    {
        Storage::disk('local')->put(self::FILE, json_encode(array_replace_recursive($this->defaults(), $impact), JSON_PRETTY_PRINT));
    }

    public function defaults(): array
    {
        $images = collect($this->sliders->all())
            ->pluck('image')
            ->filter()
            ->take(3)
            ->map(fn (string $image): array => ['image' => $image])
            ->values()
            ->all();

        return [
            'columns' => [
                ['images' => $images],
                ['images' => $images],
                ['images' => $images],
            ],
        ];
    }

    private function normalize(array $impact): array
    {
        if (! isset($impact['columns']) && isset($impact['images'])) {
            $images = collect($impact['images'])
                ->filter(fn (array $image): bool => filled($image['image'] ?? null))
                ->values()
                ->all();

            $impact['columns'] = [
                ['images' => $images],
                ['images' => $images],
                ['images' => $images],
            ];
        }

        $defaults = $this->defaults();
        $columns = array_values($impact['columns'] ?? []);

        for ($index = 0; $index < 3; $index++) {
            $columns[$index] = [
                'images' => collect($columns[$index]['images'] ?? $defaults['columns'][$index]['images'])
                    ->filter(fn (array $image): bool => filled($image['image'] ?? null))
                    ->values()
                    ->all(),
            ];
        }

        return ['columns' => array_slice($columns, 0, 3)];
    }
}
