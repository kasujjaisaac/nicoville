<?php

namespace App\Http\Controllers;

use App\Models\EventBooking;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminEventBookingController extends Controller
{
    public function index(): View
    {
        return view('admin.event-bookings', [
            'bookings' => EventBooking::latest()->paginate(20),
            'counts' => [
                'pending' => EventBooking::where('status', 'pending')->count(),
                'confirmed' => EventBooking::where('status', 'confirmed')->count(),
                'cancelled' => EventBooking::where('status', 'cancelled')->count(),
            ],
        ]);
    }

    public function update(Request $request, EventBooking $booking): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:pending,confirmed,cancelled'],
        ]);

        $booking->update($validated);

        return back()->with('status', 'Event booking updated successfully.');
    }
}
