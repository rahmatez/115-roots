<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $category = Category::where('slug', 'matchday')->first()
            ?? Category::first();

        if (! $category) {
            return;
        }

        $demoPath = 'blog/images/demo.jpg';
        $source = public_path('frontend/assets/img/blog-top.JPG');

        $disk = Storage::disk('public');

        if (! $disk->exists($demoPath) && file_exists($source)) {
            $disk->put($demoPath, file_get_contents($source));
        }

        if (! $disk->exists($demoPath)) {
            return;
        }

        Blog::updateOrCreate(
            ['slug' => 'welcome-to-suicide-squad-11-5'],
            [
                'title' => 'Welcome to Suicide Squad 11.5',
                'excerpt' => 'Kenali komunitas suporter PSS Sleman yang penuh semangat dan solidaritas.',
                'description' => '<p>Suicide Squad 11.5 adalah keluarga suporter PSS Sleman. Kami hadir untuk mendukung tim kebanggaan Sleman dengan penuh dedikasi.</p><p>Ikuti blog kami untuk update matchday, kegiatan komunitas, dan cerita dari lapangan.</p>',
                'image' => $demoPath,
                'category_id' => $category->id,
                'reads' => 0,
                'status' => 'published',
                'published_at' => now(),
                'meta_title' => 'Welcome to Suicide Squad 11.5',
                'meta_description' => 'Kenali komunitas suporter PSS Sleman Suicide Squad 11.5.',
            ]
        );
    }
}
