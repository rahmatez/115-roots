<?php

namespace Tests\Feature;

use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_loads(): void
    {
        $response = $this->get(route('homepage'));

        $response->assertOk();
    }

    public function test_sitemap_is_accessible(): void
    {
        $response = $this->get(route('sitemap'));

        $response->assertOk();
        $response->assertHeader('Content-Type', 'application/xml');
    }

    public function test_rss_feed_is_accessible(): void
    {
        $response = $this->get(route('feed'));

        $response->assertOk();
    }

    public function test_draft_blog_is_not_visible_publicly(): void
    {
        $category = Category::create(['name' => 'News', 'slug' => 'news']);
        $blog = Blog::create([
            'title' => 'Draft Post',
            'slug' => 'draft-post',
            'excerpt' => 'Hidden excerpt',
            'image' => 'blog/images/test.jpg',
            'description' => 'Hidden content',
            'category_id' => $category->id,
            'status' => 'draft',
            'published_at' => null,
        ]);

        $this->get(route('blog.show', $blog->slug))->assertNotFound();
    }

    public function test_admin_routes_require_authentication(): void
    {
        $this->get(route('admin.dashboard'))->assertRedirect(route('login'));
    }

    public function test_non_admin_cannot_access_admin_panel(): void
    {
        $user = User::factory()->create(['is_admin' => false]);

        $this->actingAs($user)->get(route('admin.dashboard'))->assertForbidden();
    }
}
