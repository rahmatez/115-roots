<hr><h5>Social Links</h5>
@php
    $links = ! empty($links) ? $links : [['platform' => '', 'icon' => 'bx-link', 'handle' => '', 'url' => '']];
@endphp
@foreach($links as $index => $link)
    <div class="border rounded p-3 mb-2">
        <div class="form-row">
            <div class="form-group col-md-3">
                <label>Platform</label>
                <input type="text" name="social_links[{{ $index }}][platform]" class="form-control" value="{{ $link['platform'] ?? '' }}" placeholder="Instagram">
            </div>
            <div class="form-group col-md-3">
                <label>Icon class</label>
                <input type="text" name="social_links[{{ $index }}][icon]" class="form-control" value="{{ $link['icon'] ?? 'bx-link' }}" placeholder="bxl-instagram">
            </div>
            <div class="form-group col-md-3">
                <label>Handle</label>
                <input type="text" name="social_links[{{ $index }}][handle]" class="form-control" value="{{ $link['handle'] ?? '' }}">
            </div>
            <div class="form-group col-md-3">
                <label>URL</label>
                <input type="url" name="social_links[{{ $index }}][url]" class="form-control" value="{{ $link['url'] ?? '' }}">
            </div>
        </div>
    </div>
@endforeach
<p class="text-muted">Leave URL empty to hide a link. Add more rows by saving and editing again, or duplicate fields manually.</p>
