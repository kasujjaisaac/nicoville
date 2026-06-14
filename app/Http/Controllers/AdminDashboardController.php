<?php

namespace App\Http\Controllers;

use App\Models\EventBooking;
use App\Models\ContactMessage;
use App\Models\Donation;
use App\Support\EventsRepository;
use App\Support\HeroSliderRepository;
use App\Support\CausesRepository;
use App\Support\NewsRepository;
use App\Support\ProjectsRepository;
use App\Support\TeamRepository;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function __invoke(
        HeroSliderRepository $slides,
        ProjectsRepository $projects,
        CausesRepository $causes,
        EventsRepository $events,
        NewsRepository $news,
        TeamRepository $team,
    ): View {
        return view('admin.dashboard', [
            'counts' => [
                'slides' => count($slides->all()),
                'projects' => count($projects->all()),
                'causes' => count($causes->all()),
                'events' => count($events->all()),
                'news' => count($news->all()),
                'team' => count($team->all()),
                'messages' => ContactMessage::where('status', 'new')->count(),
                'donations' => Donation::where('status', 'pending')->count(),
                'pending_bookings' => EventBooking::where('status', 'pending')->count(),
            ],
            'latestBookings' => EventBooking::latest()->take(5)->get(),
        ]);
    }
}
