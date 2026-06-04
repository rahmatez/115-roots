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
                'title' => 'SUICIDE SQUAD 11.5',
                'subtitle' => 'Who We Are',
                'content' => '<p>"Suicide Squad 11.5" is a community of supporters dedicated to the PSS Sleman football club. The name describes the enthusiasm and courage of its members in supporting their favorite team.</p><p>We are not just a supporter group, but also a family for our members — a platform for exchanging ideas, experiences, and social activities that strengthen relationships among fellow football fans.</p>',
                'meta_title' => 'About Us | Suicide Squad 11.5',
                'meta_description' => 'Learn about Suicide Squad 11.5, the supporter community for PSS Sleman.',
            ]
        );

        Page::updateOrCreate(
            ['slug' => 'faqs'],
            [
                'title' => 'Frequently Asked Questions',
                'subtitle' => 'Help Center',
                'content' => '<p><strong>What is Suicide Squad 11.5?</strong></p><p>We are a supporter community for PSS Sleman, united under the Eleven Five Roots banner.</p><p><strong>How can I join events?</strong></p><p>Check the Events page or follow our social media for the latest nobar, away day, and gathering schedules.</p><p><strong>Where can I buy merchandise?</strong></p><p>Visit our Shop page for official supporter merchandise and gear.</p><p><strong>How do I contact the team?</strong></p><p>Use the Contact page or reach us via social media links in the footer.</p>',
                'meta_title' => 'FAQs | Suicide Squad 11.5',
                'meta_description' => 'Frequently asked questions about Suicide Squad 11.5 supporter community.',
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
                'meta_title' => 'Eleven Five Roots | Suicide Squad 11.5',
                'meta_description' => 'Unite To Empower — Supporter community for PSS Sleman.',
                'settings' => [
                    'hero_title' => 'Eleven Five Roots',
                    'hero_subtitle' => 'Unite To Empower',
                    'hero_images' => [
                        'frontend/assets/img/hero/hero-1.jpeg',
                        'frontend/assets/img/hero/hero-2.jpeg',
                        'frontend/assets/img/hero/hero-3.jpeg',
                        'frontend/assets/img/hero/hero-4.jpeg',
                        'frontend/assets/img/hero/hero-5.jpeg',
                    ],
                    'footer_description' => 'Our vision is to provide the best service and share the best experience for many people',
                    'footer_copyright' => 'SUICIDE SQUAD 11.5. All rights reserved.',
                    'partner_logos' => [
                        ['name' => '11.5 CREW', 'image' => 'frontend/assets/img/logo/logo-ss-white.png', 'url' => ''],
                        ['name' => 'ELEVEN 5', 'image' => 'frontend/assets/img/logo/emblem w.png', 'url' => ''],
                        ['name' => 'Suicide Squad', 'image' => 'frontend/assets/img/logo/EMBLEM.png', 'url' => ''],
                    ],
                    'social_links' => [
                        ['platform' => 'Twitter', 'url' => 'https://twitter.com/suicidesquad76', 'icon' => 'bxl-twitter'],
                        ['platform' => 'Instagram', 'url' => 'https://www.instagram.com/suicidesquad11.5/', 'icon' => 'bxl-instagram-alt'],
                        ['platform' => 'Youtube', 'url' => 'https://www.youtube.com/@suicidesquad11.52', 'icon' => 'bxl-youtube'],
                    ],
                    'announcement_active' => false,
                    'announcement_text' => '',
                    'announcement_url' => '',
                    'youtube_embed_url' => 'https://www.youtube.com/embed/fLLJzNB15mI?si=CY6u_7UdphzYDAB2',
                    'youtube_channel_url' => 'https://www.youtube.com/@suicidesquad11.52',
                    'instagram_username' => 'suicidesquad11.5',
                    'instagram_user_id' => '',
                    'instagram_access_token' => '',
                    'instagram_limit' => 25,
                ],
            ]
        );
    }
}
