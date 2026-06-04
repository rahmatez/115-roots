<?php

namespace App\Support;

class HeroImages
{
    public const DEFAULT = [
        'frontend/assets/img/hero/hero-1.jpeg',
        'frontend/assets/img/hero/hero-2.jpeg',
        'frontend/assets/img/hero/hero-3.jpeg',
        'frontend/assets/img/hero/hero-4.jpeg',
        'frontend/assets/img/hero/hero-5.jpeg',
    ];

    public static function resolve(?array $fromSettings): array
    {
        if (! empty($fromSettings)) {
            $images = array_values(array_filter($fromSettings));

            if (! empty($images)) {
                return $images;
            }
        }

        return self::DEFAULT;
    }
}
