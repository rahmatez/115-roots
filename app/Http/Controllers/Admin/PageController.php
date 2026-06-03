<?php

namespace App\Http\Controllers\Admin;

use App\Models\Page;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PageRequest;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::orderBy('slug')->get();

        return view('admin.pages.index', compact('pages'));
    }

    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function update(PageRequest $request, Page $page)
    {
        $data = $request->validated();

        if ($page->slug === 'site_settings') {
            $existing = $page->settings ?? [];
            $data['settings'] = array_merge($existing, [
                'hero_title' => $request->input('hero_title'),
                'hero_subtitle' => $request->input('hero_subtitle'),
                'footer_description' => $request->input('footer_description'),
                'footer_copyright' => $request->input('footer_copyright'),
                'social_links' => $this->normalizeSocialLinks($request->input('social_links', [])),
                'partner_logos' => $this->normalizePartnerLogos($request->input('partner_logos', [])),
                'hero_images' => array_values(array_filter($request->input('hero_images', []))),
                'announcement_active' => $request->boolean('announcement_active'),
                'announcement_text' => $request->input('announcement_text'),
                'announcement_url' => $request->input('announcement_url'),
                'youtube_embed_url' => $request->input('youtube_embed_url'),
                'youtube_channel_url' => $request->input('youtube_channel_url'),
            ]);
            $data['content'] = null;
        }

        if ($page->slug === 'contact') {
            $data['settings'] = [
                'social_links' => $this->normalizeSocialLinks($request->input('social_links', [])),
            ];
        }

        $page->update($data);

        return redirect()->route('admin.pages.index')->with([
            'message' => 'Page updated successfully!',
            'alert-type' => 'success',
        ]);
    }

    private function normalizeSocialLinks(array $links): array
    {
        return collect($links)
            ->filter(fn ($link) => ! empty($link['url']))
            ->values()
            ->map(fn ($link) => [
                'platform' => $link['platform'] ?? '',
                'icon' => $link['icon'] ?? 'bx-link',
                'handle' => $link['handle'] ?? '',
                'url' => $link['url'],
            ])
            ->all();
    }

    private function normalizePartnerLogos(array $logos): array
    {
        return collect($logos)
            ->filter(fn ($logo) => ! empty($logo['image']))
            ->values()
            ->map(fn ($logo) => [
                'name' => $logo['name'] ?? '',
                'image' => $logo['image'],
                'url' => $logo['url'] ?? '',
            ])
            ->all();
    }
}
