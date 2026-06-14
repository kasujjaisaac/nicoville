<?php

namespace App\Http\Controllers;

use App\Support\CertificatesRepository;
use App\Support\SiteSettingsRepository;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CertificateController extends Controller
{
    public function index(CertificatesRepository $certificates, SiteSettingsRepository $settings): View
    {
        return view('certificates', [
            'active' => '/certificates',
            'certificates' => $certificates->all(),
            'settings' => $settings->get(),
        ]);
    }

    public function image(string $slug, CertificatesRepository $certificates): Response
    {
        $certificate = $certificates->find($slug);

        abort_if(! $certificate || ! Storage::disk('local')->exists($certificate['file_path']), 404);

        $contents = Storage::disk('local')->get($certificate['file_path']);
        $size = @getimagesizefromstring($contents);
        $width = $size[0] ?? 1200;
        $height = $size[1] ?? 850;
        $mime = $size['mime'] ?? 'image/png';
        $encoded = base64_encode($contents);
        $title = e($certificate['title']);

        $svg = <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" width="{$width}" height="{$height}" viewBox="0 0 {$width} {$height}" role="img" aria-label="{$title}">
  <defs>
    <pattern id="watermark" width="420" height="150" patternUnits="userSpaceOnUse" patternTransform="rotate(-24)">
      <text x="12" y="82" font-family="Arial, Helvetica, sans-serif" font-size="30" font-weight="800" fill="#0f6f4d" fill-opacity="0.18">COPY BY NICOVILLE FOUNDATION</text>
    </pattern>
  </defs>
  <image href="data:{$mime};base64,{$encoded}" width="{$width}" height="{$height}" preserveAspectRatio="xMidYMid meet"/>
  <rect width="{$width}" height="{$height}" fill="url(#watermark)"/>
  <rect x="10" y="10" width="{$width}" height="{$height}" fill="none" stroke="#0f6f4d" stroke-opacity="0.22" stroke-width="20"/>
</svg>
SVG;

        return response($svg, 200, [
            'Content-Type' => 'image/svg+xml',
            'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
            'Pragma' => 'no-cache',
            'X-Content-Type-Options' => 'nosniff',
        ]);
    }
}
