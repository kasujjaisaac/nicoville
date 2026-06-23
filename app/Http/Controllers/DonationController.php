<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Support\SiteSettingsRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DonationController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'cause' => ['required', 'string', 'max:180'],
            'name' => ['required', 'string', 'max:160'],
            'email' => ['required', 'email', 'max:180'],
            'phone' => ['required', 'string', 'max:80'],
            'amount' => ['required', 'integer', 'min:1'],
            'currency' => ['nullable', 'string', 'in:USD'],
            'payment_method' => ['nullable', 'string', 'max:80'],
            'message' => ['nullable', 'string', 'max:1200'],
        ]);

        $donation = Donation::create([
            ...$validated,
            'currency' => 'USD',
            'payment_method' => $validated['payment_method'] ?? 'pending',
            'status' => 'pending',
        ]);

        return redirect('/donation-thank-you/'.$donation->id);
    }

    public function thankYou(Donation $donation, SiteSettingsRepository $settings): View
    {
        return view('donation-thank-you', [
            'active' => '/donate',
            'donation' => $donation,
            'settings' => $settings->get(),
        ]);
    }
}
