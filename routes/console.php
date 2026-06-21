<?php

use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('nicoville:create-admin {email=admin@nicoville.org} {--name=Nicoville Admin} {--password=}', function (string $email): int {
    $password = (string) ($this->option('password') ?: env('ADMIN_PASSWORD', ''));

    if ($password === '') {
        $password = (string) $this->secret('Admin password');
    }

    if ($password === '') {
        $this->error('An admin password is required.');

        return 1;
    }

    $user = User::updateOrCreate([
        'email' => $email,
    ], [
        'name' => (string) $this->option('name'),
        'password' => Hash::make($password),
        'is_admin' => true,
    ]);

    $this->info("Admin user ready: {$user->email}");

    return 0;
})->purpose('Create or update the Nicoville admin user');

Artisan::command('nicoville:audit-runtime-content', function (): int {
    $contentRoot = storage_path('app/private');
    $references = [];

    $collectUploads = function (mixed $value, string $source) use (&$collectUploads, &$references): void {
        if (is_array($value)) {
            foreach ($value as $item) {
                $collectUploads($item, $source);
            }

            return;
        }

        if (! is_string($value) || ! str_starts_with($value, '/uploads/')) {
            return;
        }

        $path = parse_url($value, PHP_URL_PATH) ?: $value;
        $references[$path] ??= [];
        $references[$path][] = $source;
    };

    if (! File::isDirectory($contentRoot)) {
        $this->error("Runtime content folder is missing: {$contentRoot}");

        return 1;
    }

    foreach (File::files($contentRoot) as $file) {
        if ($file->getExtension() !== 'json') {
            continue;
        }

        $json = preg_replace('/^\xEF\xBB\xBF/', '', File::get($file->getPathname()));
        $decoded = json_decode($json, true);

        if (! is_array($decoded)) {
            $this->warn("Skipped invalid JSON: {$file->getFilename()}");
            continue;
        }

        $collectUploads($decoded, $file->getFilename());
    }

    if ($references === []) {
        $this->info('No /uploads/... references were found in runtime content.');

        return 0;
    }

    ksort($references);

    $rows = [];
    $missing = 0;

    foreach ($references as $path => $sources) {
        $absolutePath = public_path(ltrim($path, '/'));
        $exists = File::isFile($absolutePath);
        $missing += $exists ? 0 : 1;

        $rows[] = [
            $exists ? 'ok' : 'missing',
            $path,
            implode(', ', array_unique($sources)),
        ];
    }

    $this->table(['Status', 'Path', 'Referenced by'], $rows);

    if ($missing > 0) {
        $this->error("{$missing} referenced upload file(s) are missing from public/uploads.");

        return 1;
    }

    $this->info('All referenced upload files exist.');

    return 0;
})->purpose('Check runtime content JSON for missing uploaded media files');
