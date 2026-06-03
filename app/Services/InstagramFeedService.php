<?php

namespace App\Services;

use App\Models\Page;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class InstagramFeedService
{
    public function isConfigured(): bool
    {
        $config = $this->config();

        return filled($config['access_token']) && filled($config['user_id']);
    }

    public function profileUrl(): string
    {
        $username = ltrim($this->config()['username'] ?? 'suicidesquad11.5', '@');

        return 'https://www.instagram.com/'.$username.'/';
    }

    public function getMedia(?int $limit = null): Collection
    {
        $config = $this->config();

        if (! $this->isConfigured()) {
            return collect();
        }

        $limit = $limit ?? $config['limit'];
        $cacheKey = $this->cacheKey($config['user_id'], $limit);

        return Cache::remember($cacheKey, now()->addSeconds($config['cache_ttl']), function () use ($config, $limit) {
            return $this->fetchMedia($config['access_token'], $config['user_id'], $limit);
        });
    }

    public function clearCache(): void
    {
        $config = $this->config();

        if ($config['user_id']) {
            Cache::forget($this->cacheKey($config['user_id'], $config['limit']));
        }
    }

    private function fetchMedia(string $token, string $userId, int $limit): Collection
    {
        $response = Http::timeout(15)->get("https://graph.instagram.com/{$userId}/media", [
            'fields' => 'id,caption,media_type,media_url,thumbnail_url,permalink,timestamp',
            'limit' => min($limit, 50),
            'access_token' => $token,
        ]);

        if (! $response->successful()) {
            report(new \RuntimeException('Instagram API error: '.$response->body()));

            return collect();
        }

        return collect($response->json('data', []))
            ->filter(fn (array $item) => in_array($item['media_type'] ?? '', ['IMAGE', 'CAROUSEL_ALBUM', 'VIDEO'], true))
            ->map(fn (array $item) => $this->normalizeItem($item))
            ->values();
    }

    private function normalizeItem(array $item): array
    {
        $mediaType = $item['media_type'] ?? 'IMAGE';
        $mediaUrl = $item['media_url'] ?? '';
        $thumbnailUrl = $item['thumbnail_url'] ?? $mediaUrl;

        return [
            'id' => $item['id'],
            'caption' => $item['caption'] ?? '',
            'media_type' => $mediaType,
            'image_url' => $mediaType === 'VIDEO' ? $thumbnailUrl : $mediaUrl,
            'media_url' => $mediaUrl ?: $thumbnailUrl,
            'permalink' => $item['permalink'] ?? '',
            'timestamp' => $item['timestamp'] ?? null,
        ];
    }

    private function config(): array
    {
        $settings = Page::findBySlug('site_settings')?->settings ?? [];

        return [
            'access_token' => $settings['instagram_access_token'] ?? config('instagram.access_token'),
            'user_id' => $settings['instagram_user_id'] ?? config('instagram.user_id'),
            'username' => $settings['instagram_username'] ?? config('instagram.username'),
            'limit' => (int) ($settings['instagram_limit'] ?? config('instagram.limit', 25)),
            'cache_ttl' => config('instagram.cache_ttl', 3600),
        ];
    }

    private function cacheKey(string $userId, int $limit): string
    {
        return 'instagram_feed_'.md5($userId.'_'.$limit);
    }
}
