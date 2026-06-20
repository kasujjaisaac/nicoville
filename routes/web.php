<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminCauseController;
use App\Http\Controllers\AdminCertificateController;
use App\Http\Controllers\AdminContentController;
use App\Http\Controllers\AdminContactMessageController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminDonationController;
use App\Http\Controllers\AdminEventBookingController;
use App\Http\Controllers\AdminImpactController;
use App\Http\Controllers\AdminMediaController;
use App\Http\Controllers\AdminProjectController;
use App\Http\Controllers\AdminSiteSettingsController;
use App\Http\Controllers\AdminSliderController;
use App\Http\Controllers\AdminTeamController;
use App\Http\Controllers\AdminTestimonialsController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\DonationController;
use App\Support\CausesRepository;
use App\Support\HeroSliderRepository;
use App\Support\ImpactSectionRepository;
use App\Support\PageContentRepository;
use App\Support\ProjectsRepository;
use App\Support\SiteSettingsRepository;
use App\Support\TeamRepository;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $causes = app(CausesRepository::class);

    return view('welcome', [
        'projects' => app(ProjectsRepository::class)->all(),
        'causes' => $causes->all(),
        'causeRepo' => $causes,
        'pageContent' => app(PageContentRepository::class)->get(),
        'impact' => app(ImpactSectionRepository::class)->get(),
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

Route::get('/our-team', function () {
    return view('our-team', [
        'active' => '/our-team',
        'settings' => app(SiteSettingsRepository::class)->get(),
        'members' => app(TeamRepository::class)->all(),
    ]);
});

Route::get('/our-team/{slug}', function (string $slug) {
    $team = app(TeamRepository::class);
    $member = $team->find($slug);

    abort_if(! $member, 404);

    return view('team-member', [
        'active' => '/our-team',
        'member' => $member,
        'members' => $team->all(),
        'settings' => app(SiteSettingsRepository::class)->get(),
    ]);
});

Route::get('/donate', function () {
    return view('donate', [
        'active' => '/donate',
        'projects' => app(ProjectsRepository::class)->all(),
        'causes' => app(CausesRepository::class)->all(),
        'pageContent' => app(PageContentRepository::class)->get(),
        'settings' => app(SiteSettingsRepository::class)->get(),
    ]);
});

Route::get('/projects', function () {
    $projects = app(ProjectsRepository::class);

    return view('projects', [
        'active' => '/projects',
        'projects' => $projects->all(),
        'settings' => app(SiteSettingsRepository::class)->get(),
    ]);
});

Route::get('/projects/{slug}', function (string $slug) {
    $projects = app(ProjectsRepository::class);
    $project = $projects->find($slug);

    abort_if(! $project, 404);

    return view('project-detail', [
        'active' => '/projects',
        'project' => $project,
        'settings' => app(SiteSettingsRepository::class)->get(),
    ]);
});

Route::get('/causes', function () {
    $causes = app(CausesRepository::class);

    return view('causes', [
        'active' => '/causes',
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
        'active' => '/causes',
        'cause' => $cause,
        'causeRepo' => $causes,
        'settings' => app(SiteSettingsRepository::class)->get(),
    ]);
});

Route::get('/certificates', [CertificateController::class, 'index']);
Route::get('/certificates/{slug}/image', [CertificateController::class, 'image']);

Route::get('/contact', function () {
    return view('contact', [
        'active' => '/contact',
        'pageContent' => app(PageContentRepository::class)->get(),
        'settings' => app(SiteSettingsRepository::class)->get(),
    ]);
});

Route::post('/contact-messages', [ContactMessageController::class, 'store']);
Route::post('/donations', [DonationController::class, 'store']);
Route::get('/donation-thank-you/{donation}', [DonationController::class, 'thankYou']);

Route::get('/admin/login', [AdminAuthController::class, 'loginForm'])->name('login');
Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->middleware('auth');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', AdminDashboardController::class);
    Route::get('/admin/slider', [AdminSliderController::class, 'edit']);
    Route::post('/admin/slider', [AdminSliderController::class, 'update']);
    Route::post('/admin', [AdminSliderController::class, 'update']);
    Route::get('/admin/impact', [AdminImpactController::class, 'edit']);
    Route::post('/admin/impact', [AdminImpactController::class, 'update']);
    Route::get('/admin/testimonials', [AdminTestimonialsController::class, 'index']);
    Route::get('/admin/testimonials/create', [AdminTestimonialsController::class, 'create']);
    Route::post('/admin/testimonials', [AdminTestimonialsController::class, 'store']);
    Route::post('/admin/testimonials/heading', [AdminTestimonialsController::class, 'updateHeading']);
    Route::get('/admin/testimonials/{testimonial}/edit', [AdminTestimonialsController::class, 'edit']);
    Route::patch('/admin/testimonials/{testimonial}', [AdminTestimonialsController::class, 'update']);
    Route::delete('/admin/testimonials/{testimonial}', [AdminTestimonialsController::class, 'destroy']);
    Route::get('/admin/media', [AdminMediaController::class, 'index']);
    Route::post('/admin/media', [AdminMediaController::class, 'store']);
    Route::delete('/admin/media', [AdminMediaController::class, 'destroy']);
    Route::get('/admin/certificates', [AdminCertificateController::class, 'index']);
    Route::post('/admin/certificates', [AdminCertificateController::class, 'store']);
    Route::delete('/admin/certificates/{slug}', [AdminCertificateController::class, 'destroy']);
    Route::get('/admin/projects', [AdminProjectController::class, 'index']);
    Route::get('/admin/projects/create', [AdminProjectController::class, 'create']);
    Route::post('/admin/projects', [AdminProjectController::class, 'store']);
    Route::get('/admin/projects/{slug}/edit', [AdminProjectController::class, 'edit']);
    Route::patch('/admin/projects/{slug}', [AdminProjectController::class, 'update']);
    Route::delete('/admin/projects/{slug}', [AdminProjectController::class, 'destroy']);
    Route::get('/admin/causes', [AdminCauseController::class, 'index']);
    Route::get('/admin/causes/create', [AdminCauseController::class, 'create']);
    Route::post('/admin/causes', [AdminCauseController::class, 'store']);
    Route::get('/admin/causes/{slug}/edit', [AdminCauseController::class, 'edit']);
    Route::patch('/admin/causes/{slug}', [AdminCauseController::class, 'update']);
    Route::delete('/admin/causes/{slug}', [AdminCauseController::class, 'destroy']);
    Route::get('/admin/team', [AdminTeamController::class, 'edit']);
    Route::post('/admin/team', [AdminTeamController::class, 'update']);
    Route::get('/admin/site-settings', [AdminSiteSettingsController::class, 'edit']);
    Route::post('/admin/site-settings', [AdminSiteSettingsController::class, 'update']);
    Route::get('/admin/event-bookings', [AdminEventBookingController::class, 'index']);
    Route::patch('/admin/event-bookings/{booking}', [AdminEventBookingController::class, 'update']);
    Route::get('/admin/contact-messages', [AdminContactMessageController::class, 'index']);
    Route::patch('/admin/contact-messages/{message}', [AdminContactMessageController::class, 'update']);
    Route::get('/admin/donations', [AdminDonationController::class, 'index']);
    Route::patch('/admin/donations/{donation}', [AdminDonationController::class, 'update']);
    Route::get('/admin/content/{section}', [AdminContentController::class, 'edit']);
    Route::post('/admin/content/{section}', [AdminContentController::class, 'update']);
});
