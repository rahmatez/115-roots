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
            $data['settings'] = [
                'hero_title' => $request->input('hero_title'),
                'hero_subtitle' => $request->input('hero_subtitle'),
                'footer_description' => $request->input('footer_description'),
                'footer_copyright' => $request->input('footer_copyright'),
                'social_links' => $page->settings['social_links'] ?? [],
            ];
        }

        if ($page->slug === 'contact' && $request->filled('settings_json')) {
            $decoded = json_decode($request->input('settings_json'), true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $data['settings'] = $decoded;
            }
        }

        $page->update($data);

        return redirect()->route('admin.pages.index')->with([
            'message' => 'Page updated successfully!',
            'alert-type' => 'success',
        ]);
    }
}
