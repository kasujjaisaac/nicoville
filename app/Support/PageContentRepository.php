<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;

class PageContentRepository
{
    private const FILE = 'page-content.json';

    public function get(): array
    {
        if (Storage::disk('local')->exists(self::FILE)) {
            $content = json_decode(Storage::disk('local')->get(self::FILE), true);

            if (is_array($content)) {
                return array_replace_recursive($this->defaults(), $content);
            }
        }

        return $this->defaults();
    }

    public function save(array $content): void
    {
        Storage::disk('local')->put(self::FILE, json_encode(array_replace_recursive($this->defaults(), $content), JSON_PRETTY_PRINT));
    }

    public function defaults(): array
    {
        return [
            'home' => [
                'impact_statement' => 'Our community programs help vulnerable children access education, nutritious meals, safety and care through practical support.',
                'causes_heading' => 'Contribute to Our Causes',
                'causes_intro' => 'Your support helps us keep children in school, provide nutritious meals, and reach vulnerable children with practical care.',
                'stats_title' => 'Our Impact',
                'stats' => [
                    ['number' => 500, 'suffix' => '+', 'label' => 'Children Reached'],
                    ['number' => 120, 'suffix' => '+', 'label' => 'Families Supported'],
                    ['number' => 3, 'suffix' => '', 'label' => 'Core Programs'],
                    ['number' => 25, 'suffix' => '+', 'label' => 'Community Partners'],
                ],
                'trust_kicker' => 'Why donate us',
                'trust_title' => 'We Are a Trusted Charity Foundation',
                'trust_items' => [
                    ['title' => 'Give in the Right Place', 'text' => 'Your donation supports children and families through programs that respond to real community needs.'],
                    ['title' => 'Focused Impact', 'text' => 'We concentrate support on education, nutrition, and street children care so every gift has a clear purpose.'],
                    ['title' => 'Programs With Care', 'text' => 'Our team works with local partners to deliver practical help with dignity, accountability, and compassion.'],
                ],
                'events_kicker' => 'Events & Programs',
                'events_title' => 'Latest Events & Programs',
                'events_intro' => 'Join the work through outreach days, community support, and volunteer-led programs.',
                'news_kicker' => 'Blogs & News',
                'news_title' => 'Stories, updates, and lessons from the field.',
                'news_intro' => 'Stay close to the work through program updates, practical reflections, and community stories.',
                'contact_title' => 'Contact Us',
                'contact_intro' => 'Reach out to volunteer, partner with us, ask about upcoming events, or support one of our programs.',
                'contact_button' => 'Send Message',
                'footer_text' => 'Nicoville supports vulnerable families through transparent relief, education, health care, and community-led development programmes.',
                'footer_support_links' => [
                    ['label' => 'Make a Donation', 'url' => '/donate'],
                    ['label' => 'Sponsor Support', 'url' => '/causes'],
                    ['label' => 'Become a Volunteer', 'url' => '/contact'],
                    ['label' => 'Partner With Us', 'url' => '/contact'],
                ],
                'social_links' => [
                    ['label' => 'Facebook', 'url' => 'https://www.facebook.com/'],
                    ['label' => 'Instagram', 'url' => 'https://www.instagram.com/'],
                    ['label' => 'X', 'url' => 'https://x.com/'],
                    ['label' => 'YouTube', 'url' => 'https://www.youtube.com/'],
                ],
            ],
            'about' => [
                'vision_title' => 'Vision',
                'vision' => [
                    'A world restored by hope, sustained through faith, and transformed by love—where every broken heart is healed, every forgotten soul is remembered, and every life reflects the light of God’s compassion.',
                    'Nicoville Foundation envisions communities where darkness is overcome by hope, where faith rises even in the hardest moments, and where love flows freely—reaching the orphan, the hungry, the homeless, and the lost—bringing healing, dignity, and new beginnings.',
                ],
                'mission_title' => 'Mission',
                'mission' => [
                    'At Nicoville Foundation, our mission is to be vessels of hope, carriers of faith, and expressions of God’s love in a hurting world.',
                    'We are called to reach the forgotten and the vulnerable—feeding the hungry, sheltering the homeless, caring for orphans, and lifting children through education by providing scholastic materials and supporting their school journey. We stand beside street children, restoring their dignity and reminding them that their lives matter.',
                    'Through every act of service, we seek not only to meet physical needs but to touch hearts and awaken hope where there was despair, faith where there was doubt, and love where there was emptiness.',
                    'We believe that when love is lived out, healing begins—and through that healing, lives, communities, and generations are transformed.',
                ],
                'motto_title' => 'Motto',
                'motto' => 'Spread Love, Heal The World',
            ],
            'donate' => [
                'title' => 'Your Gift Opens Doors',
                'intro' => 'Choose a cause, share your donor details, and continue to the contributions page we shall connect next.',
                'side_title' => 'Every contribution is directed toward practical care.',
                'side_text' => 'We focus support on education, nutrition, street children care, and mentorship for vulnerable children and families.',
            ],
            'contact' => [
                'title' => 'We Would Love to Hear From You',
                'intro' => 'Reach out to volunteer, partner with us, ask about a campaign, or share a message with the Nicoville team.',
            ],
        ];
    }
}
