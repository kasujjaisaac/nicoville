<?php

namespace App\Http\Controllers;

use App\Support\ProjectsRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AdminProjectController extends Controller
{
    public function index(ProjectsRepository $projects): View
    {
        return view('admin.projects.index', [
            'projects' => $projects->all(),
        ]);
    }

    public function create(): View
    {
        return view('admin.projects.form', [
            'mode' => 'create',
            'project' => $this->blankProject(),
        ]);
    }

    public function store(Request $request, ProjectsRepository $projects): RedirectResponse
    {
        $project = $this->projectFromRequest($request);
        $allProjects = $projects->all();
        $allProjects[] = $project;

        $projects->save($allProjects);

        return redirect('/admin/projects')->with('status', 'Project added successfully.');
    }

    public function edit(string $slug, ProjectsRepository $projects): View
    {
        $project = $projects->find($slug);

        abort_if(! $project, 404);

        return view('admin.projects.form', [
            'mode' => 'edit',
            'project' => $project,
        ]);
    }

    public function update(Request $request, string $slug, ProjectsRepository $projects): RedirectResponse
    {
        $allProjects = $projects->all();
        $projectIndex = collect($allProjects)->search(fn (array $project): bool => $project['slug'] === $slug);

        abort_if($projectIndex === false, 404);

        $allProjects[$projectIndex] = $this->projectFromRequest($request, $allProjects[$projectIndex]);
        $projects->save($allProjects);

        return redirect('/admin/projects')->with('status', 'Project updated successfully.');
    }

    public function destroy(string $slug, ProjectsRepository $projects): RedirectResponse
    {
        $allProjects = collect($projects->all())
            ->reject(fn (array $project): bool => $project['slug'] === $slug)
            ->values()
            ->all();

        $projects->save($allProjects);

        return redirect('/admin/projects')->with('status', 'Project deleted successfully.');
    }

    private function projectFromRequest(Request $request, ?array $existingProject = null): array
    {
        $validated = $request->validate([
            'slug' => ['nullable', 'string', 'max:160'],
            'title' => ['required', 'string', 'max:180'],
            'category' => ['required', 'string', 'max:120'],
            'status' => ['required', 'string', 'max:80'],
            'started' => ['nullable', 'string', 'max:40'],
            'summary' => ['required', 'string', 'max:700'],
            'image' => ['nullable', 'string', 'max:700'],
            'image_file' => ['nullable', 'image', 'max:4096'],
            'gallery_text' => ['nullable', 'string', 'max:4000'],
            'gallery_files.*' => ['nullable', 'image', 'max:4096'],
            'report_file' => ['nullable', 'string', 'max:700'],
            'report_upload' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:10240'],
            'stats' => ['nullable', 'array'],
            'stats.*.number' => ['nullable', 'string', 'max:40'],
            'stats.*.label' => ['nullable', 'string', 'max:120'],
        ]);

        $image = $validated['image'] ?? ($existingProject['image'] ?? '');
        $reportFile = $validated['report_file'] ?? ($existingProject['report_file'] ?? '');

        if ($request->file('image_file')) {
            $image = $this->storeProjectImage($request->file('image_file'));
        }

        if ($request->file('report_upload')) {
            $reportFile = $this->storeProjectReport($request->file('report_upload'));
        }

        $gallery = $this->lines($validated['gallery_text'] ?? '');

        foreach ($request->file('gallery_files', []) as $galleryImage) {
            if ($galleryImage && $galleryImage->isValid()) {
                $gallery[] = $this->storeProjectImage($galleryImage);
            }
        }

        return [
            'slug' => $this->slug($validated['slug'] ?? '', $validated['title']),
            'title' => trim($validated['title']),
            'category' => trim($validated['category']),
            'status' => trim($validated['status']),
            'started' => trim($validated['started'] ?? ''),
            'image' => $image,
            'gallery' => array_values(array_unique($gallery)),
            'summary' => trim($validated['summary']),
            'stats' => collect($validated['stats'] ?? [])
                ->map(fn (array $stat): array => [
                    'number' => trim((string) ($stat['number'] ?? '')),
                    'label' => trim((string) ($stat['label'] ?? '')),
                ])
                ->filter(fn (array $stat): bool => $stat['number'] !== '' || $stat['label'] !== '')
                ->values()
                ->all(),
            'sections' => [],
            'closing_title' => '',
            'report_file' => trim($reportFile),
        ];
    }

    private function blankProject(): array
    {
        return [
            'slug' => '',
            'title' => '',
            'category' => '',
            'status' => 'Ongoing',
            'started' => '',
            'image' => '',
            'gallery' => [],
            'summary' => '',
            'stats' => [
                ['number' => '', 'label' => ''],
                ['number' => '', 'label' => ''],
                ['number' => '', 'label' => ''],
            ],
            'sections' => [],
            'closing_title' => '',
            'report_file' => '',
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

    private function slug(string $value, string $fallback): string
    {
        $slug = Str::slug($value);

        return $slug !== '' ? $slug : Str::slug($fallback);
    }

    private function storeProjectImage(\Illuminate\Http\UploadedFile $image): string
    {
        File::ensureDirectoryExists(public_path('uploads/projects'));

        $filename = uniqid('project-', true).'.'.$image->getClientOriginalExtension();
        $image->move(public_path('uploads/projects'), $filename);

        return '/uploads/projects/'.$filename;
    }

    private function storeProjectReport(\Illuminate\Http\UploadedFile $report): string
    {
        File::ensureDirectoryExists(public_path('uploads/project-reports'));

        $filename = uniqid('project-report-', true).'.'.$report->getClientOriginalExtension();
        $report->move(public_path('uploads/project-reports'), $filename);

        return '/uploads/project-reports/'.$filename;
    }
}
