<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;

class SiteSettingsRepository
{
    private const FILE = 'site-settings.json';

    public function get(): array
    {
        if (! Storage::disk('local')->exists(self::FILE)) {
            return $this->defaults();
        }

        $settings = json_decode(Storage::disk('local')->get(self::FILE), true);

        if (! is_array($settings)) {
            return $this->defaults();
        }

        $settings = array_replace_recursive($this->defaults(), $settings);
        $settings['menus'] = $this->normalizeMenus($settings['menus'] ?? []);

        return $settings;
    }

    public function save(array $settings): void
    {
        Storage::disk('local')->put(self::FILE, json_encode($settings, JSON_PRETTY_PRINT));
    }

    public function defaults(): array
    {
        return [
            'logo_image' => '',
            'logo_name' => 'Nicoville',
            'logo_tagline' => 'Charity Organisation',
            'phone_label' => '+256 700 000 000',
            'phone_href' => '+256700000000',
            'email' => 'info@nicoville.org',
            'location_label' => 'Kampala, Uganda',
            'location_url' => '#contact',
            'volunteer_label' => 'Become a Volunteer',
            'volunteer_url' => '#contact',
            'registration_number' => 'NGO/2026/NCV',
            'registration_status' => 'Active',
            'whatsapp_url' => 'https://wa.me/256709641988',
            'social_links' => [
                ['platform' => 'facebook', 'label' => 'Facebook', 'url' => 'https://www.facebook.com/'],
                ['platform' => 'instagram', 'label' => 'Instagram', 'url' => 'https://www.instagram.com/'],
                ['platform' => 'x', 'label' => 'X', 'url' => 'https://x.com/'],
                ['platform' => 'youtube', 'label' => 'YouTube', 'url' => 'https://www.youtube.com/'],
            ],
            'menus' => [
                ['label' => 'Home', 'url' => '/', 'highlight' => false, 'children' => []],
                ['label' => 'About Us', 'url' => '/about', 'highlight' => false, 'children' => [
                    ['label' => 'Who We Are', 'url' => '/about'],
                    ['label' => 'Our Team', 'url' => '/our-team'],
                ]],
                ['label' => 'Projects', 'url' => '/projects', 'highlight' => false, 'children' => []],
                ['label' => 'Causes', 'url' => '/causes', 'highlight' => false, 'children' => []],
                ['label' => 'Events', 'url' => '/events', 'highlight' => false, 'children' => []],
                ['label' => 'News', 'url' => '/news', 'highlight' => false, 'children' => []],
                ['label' => 'Certificates', 'url' => '/certificates', 'highlight' => false, 'children' => []],
                ['label' => 'Contact', 'url' => '/contact', 'highlight' => false, 'children' => []],
                ['label' => 'Donate', 'url' => '/donate', 'highlight' => true, 'children' => []],
            ],
        ];
    }

    private function normalizeMenus(array $menus): array
    {
        $menus = collect($menus)
            ->map(function (array $menu): array {
                return [
                    'label' => $menu['label'] ?? '',
                    'url' => $menu['url'] ?? '#',
                    'highlight' => (bool) ($menu['highlight'] ?? false),
                    'children' => collect($menu['children'] ?? [])
                        ->map(fn (array $child): array => [
                            'label' => $child['label'] ?? '',
                            'url' => $child['url'] ?? '#',
                        ])
                        ->filter(fn (array $child): bool => $child['label'] !== '')
                        ->values()
                        ->all(),
                ];
            })
            ->reject(fn (array $menu): bool => strcasecmp($menu['label'], 'Publications') === 0)
            ->filter(fn (array $menu): bool => $menu['label'] !== '')
            ->values()
            ->all();

        $menus = $this->ensureAboutMenu($menus);

        $causeMenu = collect($menus)->first(fn (array $menu): bool => $menu['url'] === '/causes') ?? [
            'label' => 'Causes',
            'url' => '/causes',
            'highlight' => false,
            'children' => [],
        ];

        $menus = collect($menus)
            ->reject(fn (array $menu): bool => $menu['url'] === '/causes')
            ->values()
            ->all();

        $projectsIndex = collect($menus)->search(fn (array $menu): bool => $menu['url'] === '/projects');
        array_splice($menus, $projectsIndex === false ? min(3, count($menus)) : $projectsIndex + 1, 0, [$causeMenu]);

        $certificateMenu = collect($menus)->first(fn (array $menu): bool => $menu['url'] === '/certificates') ?? [
            'label' => 'Certificates',
            'url' => '/certificates',
            'highlight' => false,
            'children' => [],
        ];

        $menus = collect($menus)
            ->reject(fn (array $menu): bool => $menu['url'] === '/certificates')
            ->values()
            ->all();

        $contactIndex = collect($menus)->search(fn (array $menu): bool => $menu['url'] === '/contact');
        $insertAt = $contactIndex === false ? max(count($menus) - 1, 0) : $contactIndex;
        array_splice($menus, $insertAt, 0, [$certificateMenu]);

        $contactIndex = collect($menus)->search(fn (array $menu): bool => $menu['url'] === '/contact');
        $donateIndex = collect($menus)->search(fn (array $menu): bool => $menu['url'] === '/donate');

        if ($contactIndex !== false && $donateIndex !== false && $donateIndex < $contactIndex) {
            $donateMenu = $menus[$donateIndex];
            array_splice($menus, $donateIndex, 1);
            $contactIndex = collect($menus)->search(fn (array $menu): bool => $menu['url'] === '/contact');
            array_splice($menus, $contactIndex + 1, 0, [$donateMenu]);
        }

        return $menus;
    }

    private function ensureAboutMenu(array $menus): array
    {
        $aboutChildren = [
            ['label' => 'Who We Are', 'url' => '/about'],
            ['label' => 'Our Team', 'url' => '/our-team'],
        ];

        $aboutIndex = collect($menus)->search(
            fn (array $menu): bool => $menu['url'] === '/about' || strcasecmp($menu['label'], 'About') === 0 || strcasecmp($menu['label'], 'About Us') === 0
        );

        if ($aboutIndex === false) {
            $homeIndex = collect($menus)->search(fn (array $menu): bool => $menu['url'] === '/');
            array_splice($menus, $homeIndex === false ? 0 : $homeIndex + 1, 0, [[
                'label' => 'About Us',
                'url' => '/about',
                'highlight' => false,
                'children' => $aboutChildren,
            ]]);

            return $menus;
        }

        $existingChildren = collect($menus[$aboutIndex]['children'] ?? [])
            ->reject(fn (array $child): bool => in_array($child['url'] ?? '', ['/about', '/our-team'], true))
            ->values()
            ->all();

        $menus[$aboutIndex]['label'] = 'About Us';
        $menus[$aboutIndex]['url'] = '/about';
        $menus[$aboutIndex]['highlight'] = false;
        $menus[$aboutIndex]['children'] = array_merge($aboutChildren, $existingChildren);

        return $menus;
    }
}
