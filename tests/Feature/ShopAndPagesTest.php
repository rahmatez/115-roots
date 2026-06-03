<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShopAndPagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_shop_page_loads(): void
    {
        $this->get(route('shop.index'))->assertOk();
    }

    public function test_faqs_page_loads(): void
    {
        $this->seed(\Database\Seeders\PageSeeder::class);

        $this->get(route('faqs'))->assertOk();
    }

    public function test_published_product_is_visible_on_shop(): void
    {
        $product = Product::create([
            'name' => 'Test Scarf',
            'slug' => 'test-scarf',
            'price' => 50000,
            'currency' => 'IDR',
            'image' => 'frontend/assets/img/gal-1.jpg',
            'is_published' => true,
        ]);

        $this->get(route('shop.show', $product->slug))->assertOk();
    }

    public function test_unpublished_product_returns_404(): void
    {
        $product = Product::create([
            'name' => 'Hidden Item',
            'slug' => 'hidden-item',
            'price' => 10000,
            'currency' => 'IDR',
            'image' => 'frontend/assets/img/gal-1.jpg',
            'is_published' => false,
        ]);

        $this->get(route('shop.show', $product->slug))->assertNotFound();
    }

    public function test_published_event_appears_on_events_page(): void
    {
        Event::create([
            'title' => 'Nobar Test Match',
            'slug' => 'nobar-test-match',
            'description' => 'Test event description',
            'location' => 'Sleman',
            'event_date' => now()->addWeek(),
            'is_published' => true,
        ]);

        $this->get(route('events.index'))
            ->assertOk()
            ->assertSee('Nobar Test Match');
    }

    public function test_admin_products_requires_auth(): void
    {
        $this->get(route('admin.products.index'))->assertRedirect(route('login'));
    }

    public function test_admin_can_access_products(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $this->actingAs($admin)->get(route('admin.products.index'))->assertOk();
    }
}
