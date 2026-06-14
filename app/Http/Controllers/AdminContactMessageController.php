<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminContactMessageController extends Controller
{
    public function index(): View
    {
        return view('admin.contact-messages', [
            'messages' => ContactMessage::latest()->paginate(20),
            'counts' => [
                'new' => ContactMessage::where('status', 'new')->count(),
                'read' => ContactMessage::where('status', 'read')->count(),
                'closed' => ContactMessage::where('status', 'closed')->count(),
            ],
        ]);
    }

    public function update(Request $request, ContactMessage $message): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:new,read,closed'],
        ]);

        $message->update($validated);

        return back()->with('status', 'Contact message updated successfully.');
    }
}
