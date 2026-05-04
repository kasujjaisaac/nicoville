<?php

namespace App\Http\Controllers;

use App\Models\EventBooking;
use App\Support\EventsRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EventBookingController extends Controller
{
    public function store(Request $request, EventsRepository $events): RedirectResponse
    {
        $validated = $request->validate([
            'event_slug' => ['required', 'string', 'max:160'],
            'name' => ['required', 'string', 'max:160'],
            'email' => ['required', 'email', 'max:180'],
            'phone' => ['nullable', 'string', 'max:80'],
            'attendance_type' => ['required', 'string', 'max:80'],
            'guests' => ['required', 'integer', 'min:1', 'max:20'],
            'message' => ['nullable', 'string', 'max:1000'],
        ]);

        $event = $events->find($validated['event_slug']);
        abort_if(! $event, 404);

        EventBooking::create([
            ...$validated,
            'event_title' => $event['title'],
            'status' => 'pending',
        ]);

        return back()->with('status', 'Thank you. Your event booking has been received and is waiting for admin confirmation.');
    }
}
