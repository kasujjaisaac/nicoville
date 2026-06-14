<?php

namespace App\Http\Controllers;

use App\Support\ImpactSectionRepository;
use App\Support\PageContentRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class AdminImpactController extends Controller
{
    public function edit(ImpactSectionRepository $impact, PageContentRepository $pages): View
    {
        $pageContent = $pages->get();

        return view('admin.impact', [
            'impact' => $impact->get(),
            'impactStatement' => $pageContent['home']['impact_statement'],
        ]);
    }

    public function update(Request $request, ImpactSectionRepository $impact, PageContentRepository $pages): RedirectResponse
    {
        $validated = $request->validate([
            'impact_statement' => ['required', 'string', 'max:500'],
            'columns' => ['required', 'array', 'size:3'],
            'columns.*.images' => ['required', 'array', 'min:1'],
            'columns.*.images.*.image_url' => ['nullable', 'string', 'max:700'],
            'columns.*.images.*.image_file' => ['nullable', 'image', 'max:4096'],
        ]);

        $currentColumns = $impact->get()['columns'];
        $columns = [];

        foreach ($validated['columns'] as $columnIndex => $columnInput) {
            $images = [];

            foreach ($columnInput['images'] as $imageIndex => $imageInput) {
                $image = $imageInput['image_url'] ?? ($currentColumns[$columnIndex]['images'][$imageIndex]['image'] ?? '');
                $uploadedImage = $request->file("columns.{$columnIndex}.images.{$imageIndex}.image_file");

                if ($uploadedImage) {
                    File::ensureDirectoryExists(public_path('uploads/impact'));

                    $filename = uniqid('impact-', true).'.'.$uploadedImage->getClientOriginalExtension();
                    $uploadedImage->move(public_path('uploads/impact'), $filename);
                    $image = '/uploads/impact/'.$filename;
                }

                if (filled($image)) {
                    $images[] = ['image' => $image];
                }
            }

            if ($images === []) {
                $images = $currentColumns[$columnIndex]['images'] ?? [];
            }

            $columns[] = ['images' => $images];
        }

        $impact->save(['columns' => $columns]);

        $pageContent = $pages->get();
        $pageContent['home']['impact_statement'] = $validated['impact_statement'];
        $pages->save($pageContent);

        return redirect('/admin/impact')->with('status', 'Impact section updated successfully.');
    }
}
