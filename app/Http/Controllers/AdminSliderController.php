<?php

namespace App\Http\Controllers;

use App\Support\HeroSliderRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class AdminSliderController extends Controller
{
    public function __construct(private readonly HeroSliderRepository $sliders)
    {
    }

    public function edit(): View
    {
        return view('admin.slider', [
            'slides' => $this->sliders->all(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'slides' => ['required', 'array', 'min:1'],
            'slides.*.eyebrow' => ['required', 'string', 'max:120'],
            'slides.*.title' => ['required', 'string', 'max:180'],
            'slides.*.lead' => ['required', 'string', 'max:500'],
            'slides.*.image_url' => ['nullable', 'string', 'max:700'],
            'slides.*.image_file' => ['nullable', 'image', 'max:4096'],
            'slides.*.primary_label' => ['required', 'string', 'max:40'],
            'slides.*.primary_url' => ['required', 'string', 'max:200'],
            'slides.*.secondary_label' => ['required', 'string', 'max:40'],
            'slides.*.secondary_url' => ['required', 'string', 'max:200'],
        ]);

        $currentSlides = $this->sliders->all();
        $slides = [];

        foreach ($validated['slides'] as $index => $slide) {
            $image = $slide['image_url'] ?? ($currentSlides[$index]['image'] ?? '');
            $uploadedImage = $request->file("slides.{$index}.image_file");

            if ($uploadedImage) {
                File::ensureDirectoryExists(public_path('uploads/slides'));

                $filename = uniqid('slide-', true).'.'.$uploadedImage->getClientOriginalExtension();
                $uploadedImage->move(public_path('uploads/slides'), $filename);
                $image = '/uploads/slides/'.$filename;
            }

            $slides[] = [
                'image' => $image,
                'eyebrow' => $slide['eyebrow'],
                'title' => $slide['title'],
                'lead' => $slide['lead'],
                'primary_label' => $slide['primary_label'],
                'primary_url' => $slide['primary_url'],
                'secondary_label' => $slide['secondary_label'],
                'secondary_url' => $slide['secondary_url'],
            ];
        }

        $this->sliders->save($slides);

        return redirect('/admin')->with('status', 'Hero slider updated successfully.');
    }
}
