<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CertificatesRepository
{
    private const FILE = 'certificates.json';

    public function all(): array
    {
        if (Storage::disk('local')->exists(self::FILE)) {
            $json = preg_replace('/^\xEF\xBB\xBF/', '', Storage::disk('local')->get(self::FILE));
            $certificates = json_decode($json, true);

            if (is_array($certificates)) {
                return $this->normalize($certificates);
            }
        }

        return [];
    }

    public function save(array $certificates): void
    {
        Storage::disk('local')->put(self::FILE, json_encode($this->normalize($certificates), JSON_PRETTY_PRINT));
    }

    public function find(string $slug): ?array
    {
        foreach ($this->all() as $certificate) {
            if ($certificate['slug'] === $slug) {
                return $certificate;
            }
        }

        return null;
    }

    private function normalize(array $certificates): array
    {
        $usedSlugs = [];

        return collect($certificates)
            ->map(function (array $certificate) use (&$usedSlugs): array {
                $title = trim((string) ($certificate['title'] ?? 'Certificate'));
                $slug = Str::slug($certificate['slug'] ?? $title);
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
                    'issuer' => trim((string) ($certificate['issuer'] ?? '')),
                    'registration_number' => trim((string) ($certificate['registration_number'] ?? '')),
                    'issued_on' => trim((string) ($certificate['issued_on'] ?? '')),
                    'file_path' => trim((string) ($certificate['file_path'] ?? '')),
                ];
            })
            ->filter(fn (array $certificate): bool => $certificate['title'] !== '' && $certificate['file_path'] !== '')
            ->values()
            ->all();
    }
}
