<?php

namespace App\Support;

use Illuminate\Support\Str;

class SlugGenerator
{
    public static function unique(string $title, string $modelClass, ?int $ignoreId = null): string
    {
        $slug = Str::slug($title, '-');
        $original = $slug;
        $counter = 1;

        while (self::exists($modelClass, $slug, $ignoreId)) {
            $slug = $original . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    private static function exists(string $modelClass, string $slug, ?int $ignoreId): bool
    {
        $query = $modelClass::where('slug', $slug);

        if ($ignoreId) {
            $query->where('id', '!=', $ignoreId);
        }

        return $query->exists();
    }
}
