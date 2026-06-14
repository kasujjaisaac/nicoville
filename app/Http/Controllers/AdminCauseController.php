<?php

namespace App\Http\Controllers;

use App\Support\CausesRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AdminCauseController extends Controller
{
    public function index(CausesRepository $causes): View
    {
        return view('admin.causes.index', [
            'causes' => $causes->all(),
            'causeRepo' => $causes,
        ]);
    }

    public function create(): View
    {
        return view('admin.causes.form', [
            'mode' => 'create',
            'cause' => $this->blankCause(),
        ]);
    }

    public function store(Request $request, CausesRepository $causes): RedirectResponse
    {
        $allCauses = $causes->all();
        $allCauses[] = $this->causeFromRequest($request);
        $causes->save($allCauses);

        return redirect('/admin/causes')->with('status', 'Cause added successfully.');
    }

    public function edit(string $slug, CausesRepository $causes): View
    {
        $cause = $causes->find($slug);

        abort_if(! $cause, 404);

        return view('admin.causes.form', [
            'mode' => 'edit',
            'cause' => $cause,
        ]);
    }

    public function update(Request $request, string $slug, CausesRepository $causes): RedirectResponse
    {
        $allCauses = $causes->all();
        $causeIndex = collect($allCauses)->search(fn (array $cause): bool => $cause['slug'] === $slug);

        abort_if($causeIndex === false, 404);

        $allCauses[$causeIndex] = $this->causeFromRequest($request, $allCauses[$causeIndex]);
        $causes->save($allCauses);

        return redirect('/admin/causes')->with('status', 'Cause updated successfully.');
    }

    public function destroy(string $slug, CausesRepository $causes): RedirectResponse
    {
        $causes->save(collect($causes->all())->reject(fn (array $cause): bool => $cause['slug'] === $slug)->values()->all());

        return redirect('/admin/causes')->with('status', 'Cause deleted successfully.');
    }

    private function causeFromRequest(Request $request, ?array $existingCause = null): array
    {
        $validated = $request->validate([
            'slug' => ['nullable', 'string', 'max:160'],
            'title' => ['required', 'string', 'max:180'],
            'category' => ['required', 'string', 'max:120'],
            'brief' => ['required', 'string', 'max:700'],
            'target' => ['required', 'integer', 'min:0'],
            'raised' => ['required', 'integer', 'min:0'],
            'image' => ['nullable', 'string', 'max:700'],
            'image_file' => ['nullable', 'image', 'max:4096'],
            'details_text' => ['nullable', 'string', 'max:5000'],
            'impact_text' => ['nullable', 'string', 'max:3000'],
        ]);

        $image = $validated['image'] ?? ($existingCause['image'] ?? '');

        if ($request->file('image_file')) {
            $image = $this->storeCauseImage($request->file('image_file'));
        }

        return [
            'slug' => Str::slug($validated['slug'] ?? '') ?: Str::slug($validated['title']),
            'category' => trim($validated['category']),
            'title' => trim($validated['title']),
            'image' => $image,
            'brief' => trim($validated['brief']),
            'target' => (int) $validated['target'],
            'raised' => (int) $validated['raised'],
            'details' => $this->lines($validated['details_text'] ?? ''),
            'impact' => $this->lines($validated['impact_text'] ?? ''),
        ];
    }

    private function blankCause(): array
    {
        return [
            'slug' => '',
            'category' => '',
            'title' => '',
            'image' => '',
            'brief' => '',
            'target' => 0,
            'raised' => 0,
            'details' => [],
            'impact' => [],
        ];
    }

    private function lines(string $value): array
    {
        return collect(preg_split("/\r\n|\n|\r/", $value) ?: [])
            ->map(fn (string $line): string => trim($line))
            ->filter()
            ->values()
            ->all();
    }

    private function storeCauseImage(\Illuminate\Http\UploadedFile $image): string
    {
        File::ensureDirectoryExists(public_path('uploads/causes'));

        $filename = uniqid('cause-', true).'.'.$image->getClientOriginalExtension();
        $image->move(public_path('uploads/causes'), $filename);

        return '/uploads/causes/'.$filename;
    }
}
