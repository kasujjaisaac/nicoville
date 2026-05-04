<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;

class CausesRepository
{
    private const FILE = 'causes.json';

    public function all(): array
    {
        if (Storage::disk('local')->exists(self::FILE)) {
            $causes = json_decode(Storage::disk('local')->get(self::FILE), true);

            if (is_array($causes)) {
                return $causes;
            }
        }

        return $this->defaults();
    }

    public function save(array $causes): void
    {
        Storage::disk('local')->put(self::FILE, json_encode(array_values($causes), JSON_PRETTY_PRINT));
    }

    public function defaults(): array
    {
        return [
            [
                'slug' => 'education-support',
                'category' => 'Education',
                'title' => 'Education Support for Vulnerable Children',
                'image' => '/uploads/slides/slide-69f548425c5674.33784962.jpg',
                'brief' => 'Helping vulnerable learners stay in school with scholastic materials, fees support, uniforms, and mentorship.',
                'target' => 8000000,
                'raised' => 4850000,
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
                'target' => 6500000,
                'raised' => 3120000,
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
            [
                'slug' => 'street-children-support',
                'category' => 'Child Care',
                'title' => 'Street Children Support and Care',
                'image' => '/uploads/slides/slide-69f54850bb6117.98724716.jpeg',
                'brief' => 'Restoring dignity and hope for street-connected children through meals, hygiene kits, counseling, and follow-up care.',
                'target' => 10000000,
                'raised' => 5700000,
                'details' => [
                    'This campaign reaches street-connected children with meals, hygiene kits, counseling referrals, and safe follow-up care. We believe every child deserves dignity, protection, and a chance to rebuild trust.',
                    'The work begins with presence and consistency. Your support helps us meet immediate needs while opening pathways toward care, family tracing, mentorship, and reintegration where possible.',
                ],
                'impact' => [
                    'Provide meals, clothing, and hygiene essentials.',
                    'Support counseling referrals and follow-up care.',
                    'Create safe relationships that lead to reintegration.',
                ],
            ],
            [
                'slug' => 'youth-mentorship',
                'category' => 'Mentorship',
                'title' => 'Youth Mentorship and Development',
                'image' => '/uploads/slides/slide-69f5475f47f707.80354709.jpg',
                'brief' => 'Guiding young people through mentorship, life skills, positive activities, and community support.',
                'target' => 5500000,
                'raised' => 2350000,
                'details' => [
                    'This campaign supports mentorship and positive youth development for children and young people in vulnerable communities. We create spaces for guidance, life skills, discipline, and healthy relationships.',
                    'Mentorship helps young people see possibility beyond their current circumstances. Your contribution supports activities, materials, volunteer coordination, and follow-up support.',
                ],
                'impact' => [
                    'Run mentorship and life-skills sessions.',
                    'Support positive youth activities and guidance.',
                    'Connect young people with caring role models.',
                ],
            ],
        ];
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

    public function formatMoney(int $amount): string
    {
        return 'Sh' . number_format($amount);
    }

    public function progress(array $cause): int
    {
        if ($cause['target'] <= 0) {
            return 0;
        }

        return min(100, (int) round(($cause['raised'] / $cause['target']) * 100));
    }
}
