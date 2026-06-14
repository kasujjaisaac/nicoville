<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminDonationController extends Controller
{
    public function index(): View
    {
        return view('admin.donations', [
            'donations' => Donation::latest()->paginate(20),
            'counts' => [
                'pending' => Donation::where('status', 'pending')->count(),
                'confirmed' => Donation::where('status', 'confirmed')->count(),
                'cancelled' => Donation::where('status', 'cancelled')->count(),
            ],
        ]);
    }

    public function update(Request $request, Donation $donation): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:pending,confirmed,cancelled'],
        ]);

        $donation->update($validated);

        return back()->with('status', 'Donation updated successfully.');
    }
}
