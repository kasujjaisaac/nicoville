<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TeamRepository
{
    private const FILE = 'team-members.json';

    public function all(): array
    {
        if (Storage::disk('local')->exists(self::FILE)) {
            $members = json_decode(Storage::disk('local')->get(self::FILE), true);

            if (is_array($members)) {
                return $this->normalize($members);
            }
        }

        return $this->defaults();
    }

    public function save(array $members): void
    {
        Storage::disk('local')->put(self::FILE, json_encode($this->normalize($members), JSON_PRETTY_PRINT));
    }

    public function find(string $slug): ?array
    {
        foreach ($this->all() as $member) {
            if ($member['slug'] === $slug) {
                return $member;
            }
        }

        return null;
    }

    public function defaults(): array
    {
        return [
            [
                'slug' => 'program-director',
                'name' => 'Program Director',
                'role' => 'Leadership',
                'photo' => 'https://images.unsplash.com/photo-1551836022-d5d88e9218df?auto=format&fit=crop&w=900&q=80',
                'summary' => 'Guides the foundation strategy, partnerships, and program accountability.',
                'bio' => [
                    'The Program Director helps shape Nicoville’s mission into practical programs that serve vulnerable children, families, and communities with care.',
                    'This role coordinates strategy, partner relationships, accountability, and the day-to-day leadership needed to keep every initiative focused and responsible.',
                ],
                'email' => 'info@nicoville.org',
                'phone' => '+256 700 000 000',
            ],
            [
                'slug' => 'community-coordinator',
                'name' => 'Community Coordinator',
                'role' => 'Outreach',
                'photo' => 'https://images.unsplash.com/photo-1544717302-de2939b7ef71?auto=format&fit=crop&w=900&q=80',
                'summary' => 'Works with families, volunteers, and local partners to organize field activities.',
                'bio' => [
                    'The Community Coordinator keeps Nicoville close to the people it serves by listening to local needs and supporting field planning.',
                    'This work includes caregiver engagement, volunteer preparation, outreach scheduling, and follow-up with families after program activities.',
                ],
                'email' => 'info@nicoville.org',
                'phone' => '+256 700 000 000',
            ],
            [
                'slug' => 'volunteer-lead',
                'name' => 'Volunteer Lead',
                'role' => 'Volunteers',
                'photo' => 'https://images.unsplash.com/photo-1521791136064-7986c2920216?auto=format&fit=crop&w=900&q=80',
                'summary' => 'Supports volunteer onboarding, event preparation, and service team coordination.',
                'bio' => [
                    'The Volunteer Lead helps people serve with confidence, clarity, and respect for the children and families Nicoville reaches.',
                    'This role supports onboarding, team assignments, event readiness, safeguarding reminders, and communication with volunteers.',
                ],
                'email' => 'info@nicoville.org',
                'phone' => '+256 700 000 000',
            ],
        ];
    }

    private function normalize(array $members): array
    {
        $usedSlugs = [];

        return collect($members)
            ->map(function (array $member) use (&$usedSlugs): array {
                $name = trim((string) ($member['name'] ?? 'Team Member'));
                $slug = Str::slug($member['slug'] ?? $name);
                $slug = $slug !== '' ? $slug : 'team-member';
                $baseSlug = $slug;
                $suffix = 2;

                while (in_array($slug, $usedSlugs, true)) {
                    $slug = "{$baseSlug}-{$suffix}";
                    $suffix++;
                }

                $usedSlugs[] = $slug;

                return [
                    'slug' => $slug,
                    'name' => $name,
                    'role' => trim((string) ($member['role'] ?? 'Team')),
                    'photo' => trim((string) ($member['photo'] ?? '')),
                    'summary' => trim((string) ($member['summary'] ?? '')),
                    'bio' => collect($member['bio'] ?? [])
                        ->map(fn ($paragraph): string => trim((string) $paragraph))
                        ->filter()
                        ->values()
                        ->all(),
                    'email' => trim((string) ($member['email'] ?? '')),
                    'phone' => trim((string) ($member['phone'] ?? '')),
                ];
            })
            ->filter(fn (array $member): bool => $member['name'] !== '')
            ->values()
            ->all();
    }
}
