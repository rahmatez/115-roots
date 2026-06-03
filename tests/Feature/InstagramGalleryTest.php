<?php

namespace Tests\Feature;

use App\Models\Page;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class InstagramGalleryTest extends TestCase
{
    use RefreshDatabase;

    public function test_gallery_page_loads(): void
    {
        $this->seed(\Database\Seeders\PageSeeder::class);

        $this->get(route('gallery'))->assertOk();
    }

    public function test_gallery_displays_instagram_posts_when_configured(): void
    {
        $this->seed(\Database\Seeders\PageSeeder::class);

        Page::where('slug', 'site_settings')->update([
            'settings' => array_merge(
                Page::findBySlug('site_settings')->settings ?? [],
                [
                    'instagram_user_id' => '123456789',
                    'instagram_access_token' => 'test-token',
                    'instagram_username' => 'suicidesquad11.5',
                ]
            ),
        ]);

        Http::fake([
            'graph.instagram.com/*' => Http::response([
                'data' => [
                    [
                        'id' => 'post1',
                        'caption' => 'Match day vibes',
                        'media_type' => 'IMAGE',
                        'media_url' => 'https://example.com/photo.jpg',
                        'permalink' => 'https://instagram.com/p/abc',
                        'timestamp' => '2026-01-01T10:00:00+0000',
                    ],
                ],
            ]),
        ]);

        $this->get(route('gallery'))
            ->assertOk()
            ->assertSee('Match day vibes')
            ->assertSee('View on Instagram');
    }
}
