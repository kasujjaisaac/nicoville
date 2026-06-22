<?php

namespace App\Http\Controllers;

use App\Support\EventsRepository;
use App\Support\NewsRepository;
use App\Support\PageContentRepository;
use App\Support\ProjectsRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AdminContentController extends Controller
{
    public function edit(string $section, EventsRepository $events, NewsRepository $news, PageContentRepository $pages, ProjectsRepository $projects): View
    {
        abort_unless(array_key_exists($section, $this->sections()), 404);

        return view('admin.content-editor', [
            'section' => $section,
            'sections' => $this->sections(),
            'content' => $this->contentFor($section, $events, $news, $pages, $projects),
        ]);
    }

    public function update(Request $request, string $section, EventsRepository $events, NewsRepository $news, PageContentRepository $pages, ProjectsRepository $projects): RedirectResponse
    {
        abort_unless(array_key_exists($section, $this->sections()), 404);

        if ($section === 'projects') {
            $request->validate([
                'projects.*.image_file' => ['nullable', 'image', 'max:4096'],
                'projects.*.gallery_files.*' => ['nullable', 'image', 'max:4096'],
            ]);
        }

        $content = $this->contentFromRequest($request, $section);

        match ($section) {
            'pages' => $pages->save($content),
            'projects' => $projects->save($content),
            'events' => $events->save($content),
            'news' => $news->save($content),
        };

        return redirect("/admin/content/{$section}")->with('status', $this->sections()[$section].' updated successfully.');
    }

    private function contentFor(string $section, EventsRepository $events, NewsRepository $news, PageContentRepository $pages, ProjectsRepository $projects): array
    {
        return match ($section) {
            'pages' => $pages->get(),
            'projects' => $projects->all(),
            'events' => $events->all(),
            'news' => $news->all(),
        };
    }

    private function contentFromRequest(Request $request, string $section): array
    {
        return match ($section) {
            'pages' => $this->pageContentFromRequest($request),
            'projects' => $this->projectsFromRequest($request),
            'events' => $this->eventsFromRequest($request),
            'news' => $this->newsFromRequest($request),
        };
    }

    private function pageContentFromRequest(Request $request): array
    {
        $pages = $request->input('pages', []);
        $home = $pages['home'] ?? [];
        $about = $pages['about'] ?? [];
        $donate = $pages['donate'] ?? [];
        $contact = $pages['contact'] ?? [];

        return [
            'home' => [
                'impact_statement' => $this->text($home['impact_statement'] ?? ''),
                'causes_heading' => $this->text($home['causes_heading'] ?? ''),
                'causes_intro' => $this->text($home['causes_intro'] ?? ''),
                'stats_title' => $this->text($home['stats_title'] ?? ''),
                'stats' => collect($home['stats'] ?? [])
                    ->map(fn (array $stat): array => [
                        'number' => (int) ($stat['number'] ?? 0),
                        'suffix' => $this->text($stat['suffix'] ?? ''),
                        'label' => $this->text($stat['label'] ?? ''),
                    ])
                    ->filter(fn (array $stat): bool => $stat['label'] !== '')
                    ->values()
                    ->all(),
                'trust_kicker' => $this->text($home['trust_kicker'] ?? ''),
                'trust_title' => $this->text($home['trust_title'] ?? ''),
                'trust_items' => collect($home['trust_items'] ?? [])
                    ->map(fn (array $item): array => [
                        'title' => $this->text($item['title'] ?? ''),
                        'text' => $this->text($item['text'] ?? ''),
                    ])
                    ->filter(fn (array $item): bool => $item['title'] !== '' || $item['text'] !== '')
                    ->values()
                    ->all(),
                'testimonials_kicker' => $this->text($home['testimonials_kicker'] ?? ''),
                'testimonials_title' => $this->text($home['testimonials_title'] ?? ''),
                'testimonials_intro' => $this->text($home['testimonials_intro'] ?? ''),
                'testimonials' => collect($home['testimonials'] ?? [])
                    ->map(fn (array $item): array => [
                        'quote' => $this->text($item['quote'] ?? ''),
                        'name' => $this->text($item['name'] ?? ''),
                        'email' => $this->text($item['email'] ?? ''),
                        'role' => $this->text($item['role'] ?? ''),
                        'highlight' => $this->text($item['highlight'] ?? ''),
                        'image' => $this->text($item['image'] ?? ''),
                    ])
                    ->filter(fn (array $item): bool => $item['quote'] !== '' || $item['name'] !== '')
                    ->values()
                    ->all(),
                'events_kicker' => $this->text($home['events_kicker'] ?? ''),
                'events_title' => $this->text($home['events_title'] ?? ''),
                'events_intro' => $this->text($home['events_intro'] ?? ''),
                'news_kicker' => $this->text($home['news_kicker'] ?? ''),
                'news_title' => $this->text($home['news_title'] ?? ''),
                'news_intro' => $this->text($home['news_intro'] ?? ''),
                'contact_title' => $this->text($home['contact_title'] ?? ''),
                'contact_intro' => $this->text($home['contact_intro'] ?? ''),
                'contact_button' => $this->text($home['contact_button'] ?? ''),
                'footer_text' => $this->text($home['footer_text'] ?? ''),
                'footer_support_links' => $this->links($home['footer_support_links'] ?? []),
                'social_links' => $this->links($home['social_links'] ?? []),
            ],
            'about' => [
                'vision_title' => $this->text($about['vision_title'] ?? ''),
                'vision' => $this->lines($about['vision_text'] ?? ''),
                'mission_title' => $this->text($about['mission_title'] ?? ''),
                'mission' => $this->lines($about['mission_text'] ?? ''),
                'motto_title' => $this->text($about['motto_title'] ?? ''),
                'motto' => $this->text($about['motto'] ?? ''),
                'core_values_title' => $this->text($about['core_values_title'] ?? ''),
                'core_values_intro' => $this->text($about['core_values_intro'] ?? ''),
                'core_values' => collect($about['core_values'] ?? [])
                    ->map(fn (array $value): array => [
                        'title' => $this->text($value['title'] ?? ''),
                        'text' => $this->text($value['text'] ?? ''),
                    ])
                    ->filter(fn (array $value): bool => $value['title'] !== '' || $value['text'] !== '')
                    ->values()
                    ->all(),
                'commitment_title' => $this->text($about['commitment_title'] ?? ''),
                'commitment' => $this->text($about['commitment'] ?? ''),
            ],
            'donate' => [
                'title' => $this->text($donate['title'] ?? ''),
                'intro' => $this->text($donate['intro'] ?? ''),
                'side_title' => $this->text($donate['side_title'] ?? ''),
                'side_text' => $this->text($donate['side_text'] ?? ''),
            ],
            'contact' => [
                'title' => $this->text($contact['title'] ?? ''),
                'intro' => $this->text($contact['intro'] ?? ''),
            ],
        ];
    }

    private function eventsFromRequest(Request $request): array
    {
        return collect($request->input('events', []))
            ->map(fn (array $event): array => [
                'slug' => $this->slug($event['slug'] ?? '', $event['title'] ?? 'event'),
                'category' => $this->text($event['category'] ?? ''),
                'title' => $this->text($event['title'] ?? ''),
                'date' => $this->text($event['date'] ?? ''),
                'time' => $this->text($event['time'] ?? ''),
                'venue' => $this->text($event['venue'] ?? ''),
                'image' => $this->text($event['image'] ?? ''),
                'images' => $this->lines($event['images_text'] ?? ''),
                'summary' => $this->text($event['summary'] ?? ''),
                'details' => $this->lines($event['details_text'] ?? ''),
                'schedule' => $this->lines($event['schedule_text'] ?? ''),
            ])
            ->filter(fn (array $event): bool => $event['title'] !== '')
            ->values()
            ->all();
    }

    private function projectsFromRequest(Request $request): array
    {
        return collect($request->input('projects', []))
            ->map(function (array $project, int $index) use ($request): array {
                $sections = collect($project['sections'] ?? [])
                    ->map(fn (array $section): array => [
                        'title' => $this->text($section['title'] ?? ''),
                        'body' => $this->lines($section['body_text'] ?? ''),
                    ])
                    ->filter(fn (array $section): bool => $section['title'] !== '' || ! empty($section['body']))
                    ->values()
                    ->all();
                $mainImage = $this->text($project['image'] ?? '');
                $uploadedMainImage = $request->file("projects.{$index}.image_file");
                $gallery = $this->lines($project['gallery_text'] ?? '');

                if ($uploadedMainImage && $uploadedMainImage->isValid()) {
                    $mainImage = $this->storeProjectImage($uploadedMainImage);
                }

                foreach ($request->file("projects.{$index}.gallery_files", []) as $galleryImage) {
                    if ($galleryImage && $galleryImage->isValid()) {
                        $gallery[] = $this->storeProjectImage($galleryImage);
                    }
                }

                return [
                    'slug' => $this->slug($project['slug'] ?? '', $project['title'] ?? 'project'),
                    'title' => $this->text($project['title'] ?? ''),
                    'category' => $this->text($project['category'] ?? ''),
                    'status' => $this->text($project['status'] ?? ''),
                    'started' => $this->text($project['started'] ?? ''),
                    'image' => $mainImage,
                    'gallery' => array_values(array_unique($gallery)),
                    'summary' => $this->text($project['summary'] ?? ''),
                    'stats' => collect($project['stats'] ?? [])
                        ->map(fn (array $stat): array => [
                            'number' => $this->text($stat['number'] ?? ''),
                            'label' => $this->text($stat['label'] ?? ''),
                        ])
                        ->filter(fn (array $stat): bool => $stat['number'] !== '' || $stat['label'] !== '')
                        ->values()
                        ->all(),
                    'sections' => $sections,
                    'closing_title' => $this->text($project['closing_title'] ?? ''),
                    'report_file' => $this->text($project['report_file'] ?? ''),
                ];
            })
            ->filter(fn (array $project): bool => $project['title'] !== '')
            ->values()
            ->all();
    }

    private function newsFromRequest(Request $request): array
    {
        return collect($request->input('news', []))
            ->map(fn (array $post): array => [
                'slug' => $this->slug($post['slug'] ?? '', $post['title'] ?? 'news-update'),
                'category' => $this->text($post['category'] ?? ''),
                'date' => $this->text($post['date'] ?? ''),
                'title' => $this->text($post['title'] ?? ''),
                'summary' => $this->text($post['summary'] ?? ''),
                'image' => $this->text($post['image'] ?? ''),
                'link_label' => $this->text($post['link_label'] ?? 'Read More'),
                'details' => $this->lines($post['details_text'] ?? ''),
            ])
            ->filter(fn (array $post): bool => $post['title'] !== '')
            ->values()
            ->all();
    }

    private function links(array $links): array
    {
        return collect($links)
            ->map(fn (array $link): array => [
                'label' => $this->text($link['label'] ?? ''),
                'url' => $this->text($link['url'] ?? ''),
            ])
            ->filter(fn (array $link): bool => $link['label'] !== '' || $link['url'] !== '')
            ->values()
            ->all();
    }

    private function lines(string $value): array
    {
        return collect(preg_split("/\r\n|\n|\r/", $value) ?: [])
            ->map(fn (string $line): string => $this->text($line))
            ->filter()
            ->values()
            ->all();
    }

    private function text(mixed $value): string
    {
        return trim((string) $value);
    }

    private function slug(mixed $value, mixed $fallback): string
    {
        $slug = Str::slug($this->text($value));

        return $slug !== '' ? $slug : Str::slug($this->text($fallback));
    }

    private function storeProjectImage(\Illuminate\Http\UploadedFile $image): string
    {
        File::ensureDirectoryExists(public_path('uploads/projects'));

        $filename = uniqid('project-', true).'.'.$image->getClientOriginalExtension();
        $image->move(public_path('uploads/projects'), $filename);

        return '/uploads/projects/'.$filename;
    }

    private function sections(): array
    {
        return [
            'pages' => 'Page Text, Footer, Donate and Contact',
            'events' => 'Events and Event Detail Pages',
            'news' => 'News and Blogs',
        ];
    }
}
