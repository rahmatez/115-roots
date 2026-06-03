<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        Event::updateOrCreate(
            ['slug' => 'nobar-pss-sleman-home'],
            [
                'title' => 'Nobar PSS Sleman — Home Match',
                'description' => '<p>Bergabunglah dengan nobar bersama Suicide Squad 11.5. Bring your flag, wear your colors!</p>',
                'location' => 'Sleman, DIY',
                'event_date' => now()->addDays(14),
                'is_published' => true,
            ]
        );

        Event::updateOrCreate(
            ['slug' => 'away-day-gathering'],
            [
                'title' => 'Away Day Gathering',
                'description' => '<p>Koordinasi keberangkatan dan kumpul bareng sebelum away match.</p>',
                'location' => 'TBA',
                'event_date' => now()->addDays(30),
                'is_published' => true,
            ]
        );
    }
}
