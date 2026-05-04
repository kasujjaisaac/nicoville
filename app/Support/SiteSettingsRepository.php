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
            'menus' => [
                ['label' => 'Home', 'url' => '/', 'highlight' => false, 'children' => []],
                ['label' => 'About', 'url' => '/about', 'highlight' => false, 'children' => []],
                ['label' => 'Causes', 'url' => '/causes', 'highlight' => false, 'children' => []],
                ['label' => 'Projects', 'url' => '/projects', 'highlight' => false, 'children' => []],
                ['label' => 'Events', 'url' => '/events', 'highlight' => false, 'children' => []],
                ['label' => 'News', 'url' => '/news', 'highlight' => false, 'children' => []],
                ['label' => 'Contact', 'url' => '/contact', 'highlight' => false, 'children' => []],
                ['label' => 'Donate', 'url' => '/donate', 'highlight' => true, 'children' => []],
            ],
        ];
    }

    private function normalizeMenus(array $menus): array
    {
        return collect($menus)
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
            ->filter(fn (array $menu): bool => $menu['label'] !== '')
            ->values()
            ->all();
    }
}
