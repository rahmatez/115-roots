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
                        <div class="form-group">
                            <label>Hero Title</label>
                            <input type="text" name="hero_title" class="form-control" value="{{ old('hero_title', $page->settings['hero_title'] ?? '') }}">
                        </div>
                        <div class="form-group">
                            <label>Hero Subtitle</label>
                            <textarea name="hero_subtitle" class="form-control" rows="2">{{ old('hero_subtitle', $page->settings['hero_subtitle'] ?? '') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Footer Description</label>
                            <textarea name="footer_description" class="form-control" rows="2">{{ old('footer_description', $page->settings['footer_description'] ?? '') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Footer Copyright</label>
                            <input type="text" name="footer_copyright" class="form-control" value="{{ old('footer_copyright', $page->settings['footer_copyright'] ?? '') }}">
                        </div>
                    @else
                        <div class="form-group">
                            <label>Content</label>
                            <textarea name="content" id="content" class="form-control" rows="8">{{ old('content', $page->content) }}</textarea>
                        </div>
                    @endif

                    @if($page->slug === 'contact')
                        <div class="form-group">
                            <label>Social Links (JSON)</label>
                            <textarea name="settings_json" class="form-control" rows="10">{{ old('settings_json', json_encode($page->settings ?? [], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)) }}</textarea>
                            <small class="text-muted">Format: {"social_links":[{"platform":"...","icon":"bxl-...","handle":"...","url":"..."}]}</small>
                        </div>
                    @endif

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
