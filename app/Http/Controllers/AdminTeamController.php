<?php

namespace App\Http\Controllers;

use App\Support\TeamRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AdminTeamController extends Controller
{
    public function edit(TeamRepository $team): View
    {
        return view('admin.team', [
            'members' => $team->all(),
        ]);
    }

    public function update(Request $request, TeamRepository $team): RedirectResponse
    {
        $validated = $request->validate([
            'members' => ['required', 'array', 'min:1'],
            'members.*.name' => ['required', 'string', 'max:120'],
            'members.*.role' => ['required', 'string', 'max:120'],
            'members.*.slug' => ['nullable', 'string', 'max:140'],
            'members.*.photo_url' => ['nullable', 'string', 'max:700'],
            'members.*.photo_file' => ['nullable', 'image', 'max:4096'],
            'members.*.summary' => ['required', 'string', 'max:300'],
            'members.*.bio' => ['required', 'string', 'max:2500'],
            'members.*.email' => ['nullable', 'email', 'max:120'],
            'members.*.phone' => ['nullable', 'string', 'max:60'],
        ]);

        $currentMembers = $team->all();
        $members = [];

        foreach ($validated['members'] as $index => $member) {
            $photo = $member['photo_url'] ?? ($currentMembers[$index]['photo'] ?? '');
            $uploadedPhoto = $request->file("members.{$index}.photo_file");

            if ($uploadedPhoto) {
                File::ensureDirectoryExists(public_path('uploads/team'));

                $filename = uniqid('team-', true).'.'.$uploadedPhoto->getClientOriginalExtension();
                $uploadedPhoto->move(public_path('uploads/team'), $filename);
                $photo = '/uploads/team/'.$filename;
            }

            $members[] = [
                'slug' => Str::slug($member['slug'] ?: $member['name']),
                'name' => $member['name'],
                'role' => $member['role'],
                'photo' => $photo,
                'summary' => $member['summary'],
                'bio' => preg_split('/\R{2,}/', trim($member['bio'])) ?: [],
                'email' => $member['email'] ?? '',
                'phone' => $member['phone'] ?? '',
            ];
        }

        $team->save($members);

        return redirect('/admin/team')->with('status', 'Team members updated successfully.');
    }
}
