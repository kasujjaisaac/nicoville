<?php

namespace App\Http\Controllers;

use App\Support\SiteSettingsRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class AdminSiteSettingsController extends Controller
{
    public function __construct(private readonly SiteSettingsRepository $settings)
    {
    }

    public function edit(): View
    {
        return view('admin.site-settings', [
            'settings' => $this->settings->get(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'logo_image_url' => ['nullable', 'string', 'max:700'],
            'logo_image_file' => ['nullable', 'image', 'max:2048'],
            'phone_label' => ['required', 'string', 'max:40'],
            'phone_href' => ['required', 'string', 'max:40'],
            'email' => ['required', 'email', 'max:120'],
            'location_label' => ['required', 'string', 'max:80'],
            'location_url' => ['required', 'string', 'max:160'],
            'volunteer_label' => ['required', 'string', 'max:80'],
            'volunteer_url' => ['required', 'string', 'max:160'],
            'registration_number' => ['required', 'string', 'max:80'],
            'registration_status' => ['required', 'string', 'max:40'],
            'menus' => ['required', 'array', 'min:1'],
            'menus.*.label' => ['required', 'string', 'max:40'],
            'menus.*.url' => ['required', 'string', 'max:160'],
            'menus.*.children' => ['nullable', 'array'],
            'menus.*.children.*.label' => ['nullable', 'string', 'max:40'],
            'menus.*.children.*.url' => ['nullable', 'string', 'max:160'],
        ]);

        $currentSettings = $this->settings->get();
        $logoImage = $validated['logo_image_url'] ?? $currentSettings['logo_image'];
        $uploadedLogo = $request->file('logo_image_file');

        if ($uploadedLogo) {
            File::ensureDirectoryExists(public_path('uploads/logos'));

            $filename = uniqid('logo-', true).'.'.$uploadedLogo->getClientOriginalExtension();
            $uploadedLogo->move(public_path('uploads/logos'), $filename);
            $logoImage = '/uploads/logos/'.$filename;
        }

        $validated['logo_image'] = $logoImage;
        unset($validated['logo_image_url'], $validated['logo_image_file']);

        $validated['menus'] = collect($validated['menus'])
            ->map(function (array $menu, int $index) use ($request): array {
                return [
                    'label' => $menu['label'],
                    'url' => $menu['url'],
                    'highlight' => $request->boolean("menus.{$index}.highlight"),
                    'children' => collect($menu['children'] ?? [])
                        ->filter(fn (array $child): bool => filled($child['label'] ?? null) && filled($child['url'] ?? null))
                        ->map(fn (array $child): array => [
                            'label' => $child['label'],
                            'url' => $child['url'],
                        ])
                        ->values()
                        ->all(),
                ];
            })
            ->all();

        $this->settings->save($validated);

        return redirect('/admin/site-settings')->with('status', 'Site header settings updated successfully.');
    }
}
