<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        Page::updateOrCreate(
            ['slug' => 'about'],
            [
                'title' => 'About Us',
                'subtitle' => 'SUICIDE SQUAD 11.5',
                'content' => '<p>"Suicide Squad 11.5" is a community of supporters dedicated to the PSS Sleman football club. The name describes the enthusiasm and courage of its members in supporting their favorite team.</p><p>We are not just a supporter group, but also a family for our members — a platform for exchanging ideas, experiences, and social activities that strengthen relationships among fellow football fans.</p>',
                'meta_title' => 'About Us | Suicide Squad 11.5',
                'meta_description' => 'Learn about Suicide Squad 11.5, the supporter community for PSS Sleman.',
            ]
        );

        Page::updateOrCreate(
            ['slug' => 'contact'],
            [
                'title' => 'Contact Us',
                'subtitle' => 'Need Help',
                'content' => '<p>Are you still confused about the information on this website? Don\'t worry, just contact us for more information.</p>',
                'meta_title' => 'Contact | Suicide Squad 11.5',
                'meta_description' => 'Contact Suicide Squad 11.5 supporter community.',
                'settings' => [
                    'social_links' => [
                        ['platform' => 'Youtube', 'icon' => 'bxl-youtube', 'handle' => 'suicidesquad11.5', 'url' => 'https://www.youtube.com/@suicidesquad11.52'],
                        ['platform' => 'Twitter', 'icon' => 'bxl-twitter', 'handle' => 'suicidesquad76', 'url' => 'https://twitter.com/suicidesquad76'],
                        ['platform' => 'Email', 'icon' => 'bxs-envelope', 'handle' => 'squadsuicide170@gmail.com', 'url' => 'mailto:squadsuicide170@gmail.com'],
                        ['platform' => 'Instagram', 'icon' => 'bxl-instagram', 'handle' => 'Suicide Squad 11.5', 'url' => 'https://www.instagram.com/suicidesquad11.5/'],
                    ],
                ],
            ]
        );

        Page::updateOrCreate(
            ['slug' => 'site_settings'],
            [
                'title' => 'Site Settings',
                'subtitle' => null,
                'content' => null,
                'settings' => [
                    'hero_title' => 'SUICIDE SQUAD 11.5',
                    'hero_subtitle' => 'Here we pour out our feelings about love and anger for pride.',
                    'footer_description' => 'Our vision is to provide the best service and share the best experience for many people',
                    'footer_copyright' => 'SUICIDE SQUAD 11.5. All rights reserved.',
                    'social_links' => [
                        ['platform' => 'Twitter', 'url' => 'https://twitter.com/suicidesquad76', 'icon' => 'bxl-twitter'],
                        ['platform' => 'Instagram', 'url' => 'https://www.instagram.com/suicidesquad11.5/', 'icon' => 'bxl-instagram-alt'],
                        ['platform' => 'Youtube', 'url' => 'https://www.youtube.com/@suicidesquad11.52', 'icon' => 'bxl-youtube'],
                    ],
                ],
            ]
        );
    }
}
