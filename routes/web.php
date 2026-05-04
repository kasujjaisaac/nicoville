<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminContentController;
use App\Http\Controllers\AdminEventBookingController;
use App\Http\Controllers\AdminSiteSettingsController;
use App\Http\Controllers\AdminSliderController;
use App\Http\Controllers\EventBookingController;
use App\Support\CausesRepository;
use App\Support\EventsRepository;
use App\Support\HeroSliderRepository;
use App\Support\NewsRepository;
use App\Support\PageContentRepository;
use App\Support\SiteSettingsRepository;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome', [
        'causes' => app(CausesRepository::class)->all(),
        'events' => app(EventsRepository::class)->all(),
        'pageContent' => app(PageContentRepository::class)->get(),
        'posts' => app(NewsRepository::class)->all(),
        'slides' => app(HeroSliderRepository::class)->all(),
        'settings' => app(SiteSettingsRepository::class)->get(),
    ]);
});

Route::get('/about', function () {
    return view('about', [
        'pageContent' => app(PageContentRepository::class)->get(),
        'settings' => app(SiteSettingsRepository::class)->get(),
    ]);
});

Route::get('/causes', function () {
    $causes = app(CausesRepository::class);

    return view('causes', [
        'causes' => $causes->all(),
        'causeRepo' => $causes,
        'settings' => app(SiteSettingsRepository::class)->get(),
    ]);
});

Route::get('/causes/{slug}', function (string $slug) {
    $causes = app(CausesRepository::class);
    $cause = $causes->find($slug);

    abort_if(! $cause, 404);

    return view('cause-detail', [
        'cause' => $cause,
        'causeRepo' => $causes,
        'settings' => app(SiteSettingsRepository::class)->get(),
    ]);
});

Route::get('/donate', function () {
    $causes = app(CausesRepository::class);

    return view('donate', [
        'active' => '/donate',
        'causes' => $causes->all(),
        'pageContent' => app(PageContentRepository::class)->get(),
        'settings' => app(SiteSettingsRepository::class)->get(),
    ]);
});

Route::get('/projects', function () {
    $causes = app(CausesRepository::class);

    return view('projects', [
        'active' => '/projects',
        'projects' => collect($causes->all())->map(fn (array $cause): array => [
            'title' => $cause['title'],
            'category' => $cause['category'],
            'image' => $cause['image'],
            'summary' => $cause['brief'],
            'url' => '/causes/' . $cause['slug'],
            'focus' => [$cause['category'], 'Community Led'],
        ])->all(),
        'settings' => app(SiteSettingsRepository::class)->get(),
    ]);
});

Route::get('/news', function () {
    return view('news', [
        'active' => '/news',
        'posts' => app(NewsRepository::class)->all(),
        'settings' => app(SiteSettingsRepository::class)->get(),
    ]);
});

Route::get('/contact', function () {
    return view('contact', [
        'active' => '/contact',
        'pageContent' => app(PageContentRepository::class)->get(),
        'settings' => app(SiteSettingsRepository::class)->get(),
    ]);
});

Route::get('/events', function () {
    return view('events', [
        'active' => '/events',
        'events' => app(EventsRepository::class)->all(),
        'settings' => app(SiteSettingsRepository::class)->get(),
    ]);
});

Route::get('/events/{slug}', function (string $slug) {
    $events = app(EventsRepository::class);
    $event = $events->find($slug);

    abort_if(! $event, 404);

    return view('event-detail', [
        'active' => '/events',
        'event' => $event,
        'settings' => app(SiteSettingsRepository::class)->get(),
    ]);
});

Route::post('/events/{slug}/book', [EventBookingController::class, 'store']);

Route::get('/admin/login', [AdminAuthController::class, 'loginForm'])->name('login');
Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->middleware('auth');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminSliderController::class, 'edit']);
    Route::post('/admin', [AdminSliderController::class, 'update']);
    Route::get('/admin/site-settings', [AdminSiteSettingsController::class, 'edit']);
    Route::post('/admin/site-settings', [AdminSiteSettingsController::class, 'update']);
    Route::get('/admin/event-bookings', [AdminEventBookingController::class, 'index']);
    Route::patch('/admin/event-bookings/{booking}', [AdminEventBookingController::class, 'update']);
    Route::get('/admin/content/{section}', [AdminContentController::class, 'edit']);
    Route::post('/admin/content/{section}', [AdminContentController::class, 'update']);
});
