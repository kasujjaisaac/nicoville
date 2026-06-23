<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CausesRepository
{
    private const FILE = 'causes.json';

    public function all(): array
    {
        if (Storage::disk('local')->exists(self::FILE)) {
            $causes = json_decode(Storage::disk('local')->get(self::FILE), true);

            if (is_array($causes)) {
                return $this->normalize($causes);
            }
        }

        return $this->defaults();
    }

    public function save(array $causes): void
    {
        Storage::disk('local')->put(self::FILE, json_encode($this->normalize($causes), JSON_PRETTY_PRINT));
    }

    public function find(string $slug): ?array
    {
        foreach ($this->all() as $cause) {
            if ($cause['slug'] === $slug) {
                return $cause;
            }
        }

        return null;
    }

    public function formatMoney(int|float $amount): string
    {
        return '$'.number_format(max(0, (int) $amount));
    }

    public function progress(array $cause): int
    {
        if (($cause['target'] ?? 0) <= 0) {
            return 0;
        }

        return min(100, (int) round((($cause['raised'] ?? 0) / $cause['target']) * 100));
    }

    public function defaults(): array
    {
        return $this->normalize([
            [
                'slug' => 'education-support',
                'category' => 'Education',
                'title' => 'Education Support for Vulnerable Children',
                'image' => '/uploads/slides/slide-69f548425c5674.33784962.jpg',
                'brief' => 'Helping vulnerable learners stay in school with scholastic materials, fees support, uniforms, and mentorship.',
                'target' => 2105,
                'raised' => 1276,
                'details' => [
                    'This campaign supports children whose families are struggling to keep them in school. We provide books, pens, uniforms, sanitary pads, school fees support, and mentorship so each child has a fair chance to learn.',
                    'Education is one of the strongest paths out of vulnerability. Your contribution helps remove practical barriers that keep children away from class and restores confidence to families who feel overwhelmed.',
                ],
                'impact' => [
                    'Provide scholastic materials and school essentials.',
                    'Support school fees for selected vulnerable learners.',
                    'Encourage mentorship, attendance, and confidence.',
                ],
            ],
            [
                'slug' => 'food-and-nutrition',
                'category' => 'Nutrition',
                'title' => 'Food and Nutrition Support',
                'image' => '/uploads/slides/slide-69f5475f47f707.80354709.jpg',
                'brief' => 'Providing nutritious food packs and wellness support for children and families facing difficult seasons.',
                'target' => 1710,
                'raised' => 821,
                'details' => [
                    'This campaign provides food and nutrition support to vulnerable children and families. We focus on practical food packs, child wellness checks, and family support that helps households move through difficult moments with dignity.',
                    'A well-fed child can focus, play, learn, and grow. Each gift helps us reach homes where nutrition support can make an immediate difference.',
                ],
                'impact' => [
                    'Distribute nutritious food packs to families.',
                    'Support child wellness and caregiver guidance.',
                    'Reduce hunger-related barriers to school attendance.',
                ],
            ],
        ]);
    }

    private function normalize(array $causes): array
    {
        $usedSlugs = [];

        return collect($causes)
            ->map(function (array $cause) use (&$usedSlugs): array {
                $title = trim((string) ($cause['title'] ?? 'Cause'));
                $slug = Str::slug($cause['slug'] ?? $title) ?: Str::random(8);
                $baseSlug = $slug;
                $suffix = 2;

                while (in_array($slug, $usedSlugs, true)) {
                    $slug = "{$baseSlug}-{$suffix}";
                    $suffix++;
                }

                $usedSlugs[] = $slug;

                return [
                    'slug' => $slug,
                    'category' => trim((string) ($cause['category'] ?? 'Cause')),
                    'title' => $title,
                    'image' => trim((string) ($cause['image'] ?? '')),
                    'brief' => trim((string) ($cause['brief'] ?? '')),
                    'target' => max(0, (int) ($cause['target'] ?? 0)),
                    'raised' => max(0, (int) ($cause['raised'] ?? 0)),
                    'details' => $this->normalizeLines($cause['details'] ?? []),
                    'impact' => $this->normalizeLines($cause['impact'] ?? []),
                ];
            })
            ->filter(fn (array $cause): bool => $cause['title'] !== '')
            ->values()
            ->all();
    }

    private function normalizeLines(array|string $value): array
    {
        $lines = is_array($value) ? $value : preg_split("/\r\n|\n|\r/", $value);

        return collect($lines ?: [])
            ->map(fn ($line): string => trim((string) $line))
            ->filter()
            ->values()
            ->all();
    }
}
