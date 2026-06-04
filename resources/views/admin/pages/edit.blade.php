@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 d-flex justify-content-between">
                    <h1 class="m-0">Edit: {{ $page->title }}</h1>
                    <a href="{{ route('admin.pages.index') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="card p-3">
                <form method="post" action="{{ route('admin.pages.update', $page) }}">
                    @csrf @method('PUT')
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $page->title) }}" required>
                    </div>
                    <div class="form-group">
                        <label>Subtitle</label>
                        <input type="text" name="subtitle" class="form-control" value="{{ old('subtitle', $page->subtitle) }}">
                    </div>

                    @if($page->slug === 'site_settings')
                        <hr><h5>Hero Section</h5>
                        <div class="form-group">
                            <label>Hero Title</label>
                            <input type="text" name="hero_title" class="form-control" value="{{ old('hero_title', $page->settings['hero_title'] ?? '') }}">
                        </div>
                        <div class="form-group">
                            <label>Hero Subtitle</label>
                            <textarea name="hero_subtitle" class="form-control" rows="2">{{ old('hero_subtitle', $page->settings['hero_subtitle'] ?? '') }}</textarea>
                        </div>

                        <hr><h5>Announcement Banner</h5>
                        <div class="form-group">
                            <label><input type="checkbox" name="announcement_active" value="1" {{ old('announcement_active', $page->settings['announcement_active'] ?? false) ? 'checked' : '' }}> Show announcement on homepage</label>
                        </div>
                        <div class="form-group">
                            <label>Announcement Text</label>
                            <input type="text" name="announcement_text" class="form-control" value="{{ old('announcement_text', $page->settings['announcement_text'] ?? '') }}" placeholder="e.g. Nobar PSS Sleman — Sabtu 20:00 WIB">
                        </div>
                        <div class="form-group">
                            <label>Announcement Link (optional)</label>
                            <input type="url" name="announcement_url" class="form-control" value="{{ old('announcement_url', $page->settings['announcement_url'] ?? '') }}">
                        </div>

                        <hr><h5>Instagram Gallery</h5>
                        <p class="text-muted" style="font-size:0.875rem;">Gallery page and homepage slider pull photos from your Instagram feed via Meta Graph API.</p>
                        <div class="form-group">
                            <label>Instagram Username</label>
                            <input type="text" name="instagram_username" class="form-control"
                                value="{{ old('instagram_username', $page->settings['instagram_username'] ?? 'suicidesquad11.5') }}"
                                placeholder="suicidesquad11.5">
                        </div>
                        <div class="form-group">
                            <label>Instagram User ID</label>
                            <input type="text" name="instagram_user_id" class="form-control"
                                value="{{ old('instagram_user_id', $page->settings['instagram_user_id'] ?? '') }}"
                                placeholder="17841400000000000">
                            <small class="text-muted">Numeric Instagram Business/Creator account ID from Meta Developer.</small>
                        </div>
                        <div class="form-group">
                            <label>Instagram Access Token</label>
                            <input type="password" name="instagram_access_token" class="form-control"
                                value="{{ old('instagram_access_token', $page->settings['instagram_access_token'] ?? '') }}"
                                placeholder="Long-lived access token">
                            <small class="text-muted">Long-lived token from Instagram Graph API. Can also set <code>INSTAGRAM_ACCESS_TOKEN</code> in .env.</small>
                        </div>
                        <div class="form-group">
                            <label>Feed Limit</label>
                            <input type="number" name="instagram_limit" class="form-control" min="1" max="50"
                                value="{{ old('instagram_limit', $page->settings['instagram_limit'] ?? 25) }}">
                            <small class="text-muted">Max posts to fetch (1–50). Cached for 1 hour.</small>
                        </div>

                        <hr><h5>YouTube</h5>
                        <div class="form-group">
                            <label>YouTube Embed URL</label>
                            <input type="url" name="youtube_embed_url" class="form-control" value="{{ old('youtube_embed_url', $page->settings['youtube_embed_url'] ?? '') }}" placeholder="https://www.youtube.com/embed/VIDEO_ID">
                            <small class="text-muted">Paste embed URL for featured video on homepage.</small>
                        </div>
                        <div class="form-group">
                            <label>YouTube Channel URL</label>
                            <input type="url" name="youtube_channel_url" class="form-control" value="{{ old('youtube_channel_url', $page->settings['youtube_channel_url'] ?? '') }}" placeholder="https://www.youtube.com/@suicidesquad11.52">
                        </div>

                        <hr><h5>Footer</h5>
                        <div class="form-group">
                            <label>Footer Description</label>
                            <textarea name="footer_description" class="form-control" rows="2">{{ old('footer_description', $page->settings['footer_description'] ?? '') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Footer Copyright</label>
                            <input type="text" name="footer_copyright" class="form-control" value="{{ old('footer_copyright', $page->settings['footer_copyright'] ?? '') }}">
                            <small class="text-muted">Year {{ date('Y') }} is appended automatically on the frontend.</small>
                        </div>

                        @include('admin.pages.partials.partner_logos', [
                            'links' => old('partner_logos', $page->settings['partner_logos'] ?? []),
                            'heroImages' => old('hero_images', $page->settings['hero_images'] ?? \App\Support\HeroImages::DEFAULT),
                        ])
                        @include('admin.pages.partials.social_links', ['links' => old('social_links', $page->settings['social_links'] ?? [])])
                    @elseif($page->slug === 'contact')
                        <div class="form-group">
                            <label>Content</label>
                            <textarea name="content" id="content" class="form-control" rows="8">{{ old('content', $page->content) }}</textarea>
                        </div>
                        @include('admin.pages.partials.social_links', ['links' => old('social_links', $page->settings['social_links'] ?? [])])
                    @else
                        <div class="form-group">
                            <label>Content</label>
                            <textarea name="content" id="content" class="form-control" rows="8">{{ old('content', $page->content) }}</textarea>
                        </div>
                    @endif

                    <hr>
                    <div class="form-group">
                        <label>Meta Title (SEO)</label>
                        <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', $page->meta_title) }}">
                    </div>
                    <div class="form-group">
                        <label>Meta Description (SEO)</label>
                        <textarea name="meta_description" class="form-control" rows="2">{{ old('meta_description', $page->meta_description) }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@if($page->slug !== 'site_settings')
<script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>
<script>ClassicEditor.create(document.querySelector('#content')).catch(console.error);</script>
@endif
@endsection
