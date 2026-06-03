<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
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

    public function test_customer_can_submit_shop_order(): void
    {
        Storage::fake('public');

        $product = Product::create([
            'name' => 'Test Scarf',
            'slug' => 'test-scarf',
            'price' => 50000,
            'currency' => 'IDR',
            'image' => 'frontend/assets/img/gal-1.jpg',
            'is_published' => true,
        ]);

        $response = $this->post(route('shop.order', $product->slug), [
            'customer_name' => 'John Doe',
            'customer_address' => 'Jl. Test No. 1, Sleman',
            'customer_phone' => '08123456789',
            'payment_proof' => UploadedFile::fake()->image('proof.jpg'),
        ]);

        $response->assertRedirect(route('shop.show', $product->slug));
        $this->assertDatabaseCount('orders', 1);
        $this->assertDatabaseHas('orders', [
            'product_id' => $product->id,
            'customer_name' => 'John Doe',
            'customer_phone' => '08123456789',
        ]);
    }

    public function test_admin_can_view_orders(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $this->actingAs($admin)->get(route('admin.orders.index'))->assertOk();
    }

    public function test_admin_can_delete_order(): void
    {
        Storage::fake('public');

        $admin = User::factory()->create(['is_admin' => true]);
        $product = Product::create([
            'name' => 'Test Item',
            'slug' => 'test-item',
            'price' => 10000,
            'currency' => 'IDR',
            'image' => 'frontend/assets/img/gal-1.jpg',
            'is_published' => true,
        ]);

        $order = Order::create([
            'product_id' => $product->id,
            'customer_name' => 'Jane',
            'customer_address' => 'Address',
            'customer_phone' => '08111',
            'payment_proof' => 'orders/payment-proofs/test.jpg',
        ]);

        $this->actingAs($admin)
            ->delete(route('admin.orders.destroy', $order))
            ->assertRedirect(route('admin.orders.index'));

        $this->assertDatabaseMissing('orders', ['id' => $order->id]);
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
