<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;

class EventsRepository
{
    private const FILE = 'events.json';

    public function all(): array
    {
        if (Storage::disk('local')->exists(self::FILE)) {
            $events = json_decode(Storage::disk('local')->get(self::FILE), true);

            if (is_array($events)) {
                return $events;
            }
        }

        return $this->defaults();
    }

    public function save(array $events): void
    {
        Storage::disk('local')->put(self::FILE, json_encode(array_values($events), JSON_PRETTY_PRINT));
    }

    public function defaults(): array
    {
        return [
            [
                'slug' => 'education-care-community-day',
                'category' => 'Education Program',
                'title' => 'Education Care Community Day',
                'date' => 'July 6, 2026',
                'time' => '9:00 AM',
                'venue' => 'Kampala and nearby communities',
                'image' => '/uploads/slides/slide-69f548425c5674.33784962.jpg',
                'images' => [
                    '/uploads/slides/slide-69f548425c5674.33784962.jpg',
                    '/uploads/slides/slide-69f595fc4cf447.08726991.jpg',
                    '/uploads/slides/slide-69f5475f47f707.80354709.jpg',
                ],
                'summary' => 'A community day focused on scholastic materials, mentorship, and encouragement for vulnerable learners.',
                'details' => [
                    'This event brings together volunteers, caregivers, local leaders, and children for practical education support. We shall distribute school essentials, hold mentorship conversations, and identify learners who need follow-up support.',
                    'Visitors can attend, volunteer, contribute materials, or confirm presence so our team can plan seats, materials, and field coordination well.',
                ],
                'schedule' => [
                    'Learner registration and welcome',
                    'Scholastic materials support',
                    'Mentorship and caregiver conversations',
                    'Follow-up planning with volunteers',
                ],
            ],
            [
                'slug' => 'food-and-nutrition-outreach',
                'category' => 'Food Program',
                'title' => 'Food and Nutrition Outreach',
                'date' => 'July 6, 2026',
                'time' => '9:00 AM',
                'venue' => 'Kampala and nearby communities',
                'image' => '/uploads/slides/slide-69f5475f47f707.80354709.jpg',
                'images' => [
                    '/uploads/slides/slide-69f5475f47f707.80354709.jpg',
                    '/uploads/slides/slide-69f54850bb6117.98724716.jpeg',
                    '/uploads/slides/slide-69f595fc4cf447.08726991.jpg',
                ],
                'summary' => 'A community distribution day focused on nutritious food packs, child wellness checks, and family support conversations.',
                'details' => [
                    'This outreach supports vulnerable children and families with food packs and wellness conversations. The goal is to reduce immediate pressure while connecting caregivers to practical guidance and follow-up support.',
                    'Booking your presence helps us prepare enough food packs, assign volunteer teams, and plan the day with accountability.',
                ],
                'schedule' => [
                    'Volunteer briefing',
                    'Food pack distribution',
                    'Child wellness conversations',
                    'Family support follow-up',
                ],
            ],
            [
                'slug' => 'street-children-care-day',
                'category' => 'Care Program',
                'title' => 'Street Children Care Day',
                'date' => 'August 24, 2026',
                'time' => '2:00 PM',
                'venue' => 'Central Kampala outreach area',
                'image' => '/uploads/slides/slide-69f54850bb6117.98724716.jpeg',
                'images' => [
                    '/uploads/slides/slide-69f54850bb6117.98724716.jpeg',
                    '/uploads/slides/slide-69f548425c5674.33784962.jpg',
                    '/uploads/slides/slide-69f5475f47f707.80354709.jpg',
                ],
                'summary' => 'An outreach for street-connected children with meals, hygiene kits, counseling referrals, and reintegration follow-up.',
                'details' => [
                    'Street Children Care Day creates a safe moment of contact for children living or working on the streets. The event combines immediate care with consistent follow-up and referral support.',
                    'Visitors can confirm presence, register to volunteer, or request more details from the Nicoville team before the event day.',
                ],
                'schedule' => [
                    'Team safety briefing',
                    'Meals and hygiene kit support',
                    'Counseling referral conversations',
                    'Reintegration and follow-up planning',
                ],
            ],
            [
                'slug' => 'volunteer-orientation-and-training',
                'category' => 'Volunteer Program',
                'title' => 'Volunteer Orientation and Training',
                'date' => 'September 14, 2026',
                'time' => '10:00 AM',
                'venue' => 'Nicoville Foundation meeting point, Kampala',
                'image' => '/uploads/slides/slide-69f5475f47f707.80354709.jpg',
                'images' => [
                    '/uploads/slides/slide-69f595fc4cf447.08726991.jpg',
                    '/uploads/slides/slide-69f5475f47f707.80354709.jpg',
                    '/uploads/slides/slide-69f548425c5674.33784962.jpg',
                ],
                'summary' => 'A training session for people who want to serve children and families with dignity, safety, and compassion.',
                'details' => [
                    'This orientation prepares volunteers for field work, child safeguarding, communication, and program support. It is ideal for new volunteers and returning supporters who want to serve more consistently.',
                    'Confirming presence helps our team prepare training materials and assign roles for upcoming outreaches.',
                ],
                'schedule' => [
                    'Volunteer welcome and values',
                    'Child safeguarding basics',
                    'Program roles and expectations',
                    'Team assignments and next steps',
                ],
            ],
        ];
    }

    public function find(string $slug): ?array
    {
        foreach ($this->all() as $event) {
            if ($event['slug'] === $slug) {
                return $event;
            }
        }

        return null;
    }
}
