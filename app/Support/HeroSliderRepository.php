<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;

class HeroSliderRepository
{
    private const FILE = 'hero-slides.json';

    public function all(): array
    {
        if (! Storage::disk('local')->exists(self::FILE)) {
            return $this->defaults();
        }

        $slides = json_decode(Storage::disk('local')->get(self::FILE), true);

        if (! is_array($slides) || count($slides) === 0) {
            return $this->defaults();
        }

        return array_values(array_map(fn (array $slide) => array_merge($this->emptySlide(), $slide), $slides));
    }

    public function save(array $slides): void
    {
        Storage::disk('local')->put(self::FILE, json_encode(array_values($slides), JSON_PRETTY_PRINT));
    }

    public function defaults(): array
    {
        return [
            [
                'image' => 'https://images.unsplash.com/photo-1593113598332-cd288d649433?auto=format&fit=crop&w=1800&q=80',
                'eyebrow' => 'Together for lasting hope',
                'title' => 'Restoring dignity through practical community support.',
                'lead' => 'Nicoville works with families, volunteers, and local partners to provide food relief, education support, and compassionate care where it is needed most.',
                'primary_label' => 'Donate Now',
                'primary_url' => '#donate',
                'secondary_label' => 'Contact Us',
                'secondary_url' => '#contact',
            ],
            [
                'image' => 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?auto=format&fit=crop&w=1800&q=80',
                'eyebrow' => 'Education changes futures',
                'title' => 'Helping children stay in school and dream bigger.',
                'lead' => 'From scholastic materials to mentorship, our programmes keep young people connected to learning, safety, and opportunity.',
                'primary_label' => 'Donate Now',
                'primary_url' => '#donate',
                'secondary_label' => 'Sponsor a Child',
                'secondary_url' => '#donate',
            ],
            [
                'image' => 'https://images.unsplash.com/photo-1469571486292-0ba58a3f068b?auto=format&fit=crop&w=1800&q=80',
                'eyebrow' => 'Care with accountability',
                'title' => 'Every gift is turned into visible help on the ground.',
                'lead' => 'We focus on transparent relief work, measurable outreach, and partnerships that keep support close to the communities we serve.',
                'primary_label' => 'Make a Gift',
                'primary_url' => '#donate',
                'secondary_label' => 'Partner With Us',
                'secondary_url' => 'mailto:info@nicoville.org',
            ],
        ];
    }

    private function emptySlide(): array
    {
        return [
            'image' => '',
            'eyebrow' => '',
            'title' => '',
            'lead' => '',
            'primary_label' => '',
            'primary_url' => '',
            'secondary_label' => '',
            'secondary_url' => '',
        ];
    }
}
