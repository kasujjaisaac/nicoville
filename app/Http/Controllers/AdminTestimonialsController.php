<?php

namespace App\Http\Controllers;

use App\Support\PageContentRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class AdminTestimonialsController extends Controller
{
    public function index(PageContentRepository $pages): View
    {
        $content = $pages->get();

        return view('admin.testimonials.index', [
            'home' => $content['home'],
            'testimonials' => $content['home']['testimonials'] ?? [],
        ]);
    }

    public function create(): View
    {
        return view('admin.testimonials.form', [
            'mode' => 'create',
            'index' => null,
            'testimonial' => $this->blankTestimonial(),
        ]);
    }

    public function store(Request $request, PageContentRepository $pages): RedirectResponse
    {
        $content = $pages->get();
        $testimonials = $content['home']['testimonials'] ?? [];

        $testimonials[] = $this->testimonialFromRequest($request);
        $content['home']['testimonials'] = array_values($testimonials);

        $pages->save($content);

        return redirect('/admin/testimonials')->with('status', 'Testimonial added successfully.');
    }

    public function edit(PageContentRepository $pages, int $testimonial): View
    {
        $testimonials = $pages->get()['home']['testimonials'] ?? [];

        abort_unless(isset($testimonials[$testimonial]), 404);

        return view('admin.testimonials.form', [
            'mode' => 'edit',
            'index' => $testimonial,
            'testimonial' => array_replace($this->blankTestimonial(), $testimonials[$testimonial]),
        ]);
    }

    public function update(Request $request, PageContentRepository $pages, int $testimonial): RedirectResponse
    {
        $content = $pages->get();
        $testimonials = $content['home']['testimonials'] ?? [];

        abort_unless(isset($testimonials[$testimonial]), 404);

        $testimonials[$testimonial] = $this->testimonialFromRequest($request);
        $content['home']['testimonials'] = array_values($testimonials);

        $pages->save($content);

        return redirect('/admin/testimonials')->with('status', 'Testimonial updated successfully.');
    }

    public function destroy(PageContentRepository $pages, int $testimonial): RedirectResponse
    {
        $content = $pages->get();
        $testimonials = $content['home']['testimonials'] ?? [];

        abort_unless(isset($testimonials[$testimonial]), 404);

        unset($testimonials[$testimonial]);
        $content['home']['testimonials'] = array_values($testimonials);

        $pages->save($content);

        return redirect('/admin/testimonials')->with('status', 'Testimonial deleted successfully.');
    }

    public function updateHeading(Request $request, PageContentRepository $pages): RedirectResponse
    {
        $validated = $request->validate([
            'testimonials_kicker' => ['required', 'string', 'max:80'],
            'testimonials_title' => ['required', 'string', 'max:180'],
            'testimonials_intro' => ['required', 'string', 'max:350'],
        ]);

        $content = $pages->get();
        $content['home']['testimonials_kicker'] = $validated['testimonials_kicker'];
        $content['home']['testimonials_title'] = $validated['testimonials_title'];
        $content['home']['testimonials_intro'] = $validated['testimonials_intro'];

        $pages->save($content);

        return redirect('/admin/testimonials')->with('status', 'Testimonials section heading updated successfully.');
    }

    private function testimonialFromRequest(Request $request): array
    {
        $validated = $request->validate([
            'quote' => ['required', 'string'],
            'name' => ['required', 'string', 'max:80'],
            'email' => ['required', 'email', 'max:254'],
            'role' => ['required', 'string', 'max:120'],
            'highlight' => ['required', 'string', 'max:80'],
            'image' => ['nullable', 'string', 'max:700'],
            'image_file' => ['nullable', 'image', 'max:4096'],
        ]);

        $image = $validated['image'] ?? '';
        $uploadedImage = $request->file('image_file');

        if ($uploadedImage) {
            File::ensureDirectoryExists(public_path('uploads/testimonials'));

            $filename = uniqid('testimonial-', true).'.'.$uploadedImage->getClientOriginalExtension();
            $uploadedImage->move(public_path('uploads/testimonials'), $filename);
            $image = '/uploads/testimonials/'.$filename;
        }

        return [
            'quote' => $validated['quote'],
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'highlight' => $validated['highlight'],
            'image' => $image,
        ];
    }

    private function blankTestimonial(): array
    {
        return [
            'quote' => '',
            'name' => '',
            'email' => '',
            'role' => '',
            'highlight' => '',
            'image' => '',
        ];
    }
}
