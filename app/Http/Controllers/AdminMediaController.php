<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AdminMediaController extends Controller
{
    private const UPLOAD_ROOT = 'uploads';

    public function index(): View
    {
        return view('admin.media-library', [
            'files' => $this->files(),
            'folders' => ['media', 'slides', 'impact', 'team', 'logos'],
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'folder' => ['required', 'in:media,slides,impact,team,logos'],
            'files' => ['required', 'array', 'min:1'],
            'files.*' => ['required', 'image', 'max:4096'],
        ]);

        $targetDirectory = public_path(self::UPLOAD_ROOT.'/'.$validated['folder']);
        File::ensureDirectoryExists($targetDirectory);

        foreach ($request->file('files', []) as $file) {
            $name = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
            $name = $name !== '' ? $name : 'image';
            $filename = $name.'-'.uniqid().'.'.$file->getClientOriginalExtension();

            $file->move($targetDirectory, $filename);
        }

        return redirect('/admin/media')->with('status', 'Media uploaded successfully.');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'path' => ['required', 'string'],
        ]);

        $path = '/'.ltrim($validated['path'], '/');
        abort_unless(str_starts_with($path, '/'.self::UPLOAD_ROOT.'/'), 403);

        $absolutePath = realpath(public_path(ltrim($path, '/')));
        $uploadRoot = realpath(public_path(self::UPLOAD_ROOT));

        abort_unless($absolutePath && $uploadRoot && str_starts_with($absolutePath, $uploadRoot), 403);

        if (File::isFile($absolutePath)) {
            File::delete($absolutePath);
        }

        return redirect('/admin/media')->with('status', 'Media deleted successfully.');
    }

    private function files(): array
    {
        $root = public_path(self::UPLOAD_ROOT);

        if (! File::isDirectory($root)) {
            return [];
        }

        return collect(File::allFiles($root))
            ->filter(fn ($file): bool => in_array(strtolower($file->getExtension()), ['jpg', 'jpeg', 'png', 'gif', 'webp'], true))
            ->map(function ($file) use ($root): array {
                $relativePath = str_replace('\\', '/', Str::after($file->getPathname(), $root.DIRECTORY_SEPARATOR));
                $publicPath = '/'.self::UPLOAD_ROOT.'/'.$relativePath;

                return [
                    'name' => $file->getFilename(),
                    'path' => $publicPath,
                    'folder' => Str::before($relativePath, '/'),
                    'size' => $this->formatBytes($file->getSize()),
                    'modified' => date('M j, Y g:i A', $file->getMTime()),
                ];
            })
            ->sortByDesc('modified')
            ->values()
            ->all();
    }

    private function formatBytes(int $bytes): string
    {
        if ($bytes >= 1048576) {
            return round($bytes / 1048576, 1).' MB';
        }

        return round($bytes / 1024, 1).' KB';
    }
}
