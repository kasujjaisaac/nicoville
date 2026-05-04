<?php

namespace App\Http\Controllers;

use App\Support\CausesRepository;
use App\Support\EventsRepository;
use App\Support\NewsRepository;
use App\Support\PageContentRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminContentController extends Controller
{
    public function edit(string $section, CausesRepository $causes, EventsRepository $events, NewsRepository $news, PageContentRepository $pages): View
    {
        abort_unless(array_key_exists($section, $this->sections()), 404);

        return view('admin.content-editor', [
            'section' => $section,
            'sections' => $this->sections(),
            'content' => json_encode($this->contentFor($section, $causes, $events, $news, $pages), JSON_PRETTY_PRINT),
        ]);
    }

    public function update(Request $request, string $section, CausesRepository $causes, EventsRepository $events, NewsRepository $news, PageContentRepository $pages): RedirectResponse
    {
        abort_unless(array_key_exists($section, $this->sections()), 404);

        $validated = $request->validate([
            'content' => ['required', 'json'],
        ]);

        $content = json_decode($validated['content'], true);

        match ($section) {
            'pages' => $pages->save($content),
            'causes' => $causes->save($content),
            'events' => $events->save($content),
            'news' => $news->save($content),
        };

        return redirect("/admin/content/{$section}")->with('status', $this->sections()[$section].' updated successfully.');
    }

    private function contentFor(string $section, CausesRepository $causes, EventsRepository $events, NewsRepository $news, PageContentRepository $pages): array
    {
        return match ($section) {
            'pages' => $pages->get(),
            'causes' => $causes->all(),
            'events' => $events->all(),
            'news' => $news->all(),
        };
    }

    private function sections(): array
    {
        return [
            'pages' => 'Page Text, Footer, Donate and Contact',
            'causes' => 'Causes and Projects',
            'events' => 'Events and Event Detail Pages',
            'news' => 'News and Blogs',
        ];
    }
}
