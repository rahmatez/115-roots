<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Match Companion : Unification Series',
                'category' => 'Merchandise',
                'price' => 95000,
                'source' => 'frontend/assets/img/square-banner.jpg',
            ],
            [
                'name' => 'Away Day Scarf',
                'category' => 'Accessories',
                'price' => 85000,
                'source' => 'frontend/assets/img/gal-1.jpg',
            ],
            [
                'name' => 'Suicide Squad 11.5 Jersey',
                'category' => 'Apparel',
                'price' => 275000,
                'source' => 'frontend/assets/img/gal-2.jpg',
            ],
            [
                'name' => 'Supporter Cap',
                'category' => 'Accessories',
                'price' => 75000,
                'source' => 'frontend/assets/img/gal-3.jpg',
            ],
        ];

        $disk = Storage::disk('public');

        foreach ($products as $index => $item) {
            $slug = Str::slug($item['name']);
            $dest = 'products/' . $slug . '-' . basename($item['source']);
            $source = public_path($item['source']);

            if (! $disk->exists($dest) && file_exists($source)) {
                $disk->put($dest, file_get_contents($source));
            }

            if (! $disk->exists($dest)) {
                continue;
            }

            Product::updateOrCreate(
                ['slug' => $slug],
                [
                    'name' => $item['name'],
                    'category' => $item['category'],
                    'price' => $item['price'],
                    'currency' => 'IDR',
                    'image' => $dest,
                    'external_url' => null,
                    'sort_order' => $index,
                    'is_published' => true,
                ]
            );
        }
    }
}
