<?php

namespace App\Http\Controllers;

use App\Support\CertificatesRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AdminCertificateController extends Controller
{
    public function index(CertificatesRepository $certificates): View
    {
        return view('admin.certificates', [
            'certificates' => $certificates->all(),
        ]);
    }

    public function store(Request $request, CertificatesRepository $certificates): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:160'],
            'issuer' => ['nullable', 'string', 'max:160'],
            'registration_number' => ['nullable', 'string', 'max:120'],
            'issued_on' => ['nullable', 'string', 'max:80'],
            'certificate_file' => ['required', 'image', 'max:8192'],
        ]);

        $file = $request->file('certificate_file');
        $filename = uniqid('certificate-', true).'.'.$file->getClientOriginalExtension();
        $path = $file->storeAs('certificates', $filename, 'local');

        $allCertificates = $certificates->all();
        $allCertificates[] = [
            'slug' => Str::slug($validated['title']),
            'title' => $validated['title'],
            'issuer' => $validated['issuer'] ?? '',
            'registration_number' => $validated['registration_number'] ?? '',
            'issued_on' => $validated['issued_on'] ?? '',
            'file_path' => $path,
        ];

        $certificates->save($allCertificates);

        return redirect('/admin/certificates')->with('status', 'Certificate uploaded successfully.');
    }

    public function destroy(string $slug, CertificatesRepository $certificates): RedirectResponse
    {
        $certificate = $certificates->find($slug);

        if ($certificate && Storage::disk('local')->exists($certificate['file_path'])) {
            Storage::disk('local')->delete($certificate['file_path']);
        }

        $certificates->save(
            collect($certificates->all())
                ->reject(fn (array $certificate): bool => $certificate['slug'] === $slug)
                ->values()
                ->all()
        );

        return redirect('/admin/certificates')->with('status', 'Certificate removed successfully.');
    }
}
