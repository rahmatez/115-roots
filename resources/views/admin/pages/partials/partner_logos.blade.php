<hr><h5>Partner Logos (Hero Banner)</h5>
@php
    $partnerLogos = ! empty($links) ? $links : [['name' => '', 'image' => '', 'url' => '']];
@endphp
@foreach($partnerLogos as $index => $logo)
    <div class="border rounded p-3 mb-2">
        <div class="form-row">
            <div class="form-group col-md-3">
                <label>Name</label>
                <input type="text" name="partner_logos[{{ $index }}][name]" class="form-control" value="{{ $logo['name'] ?? '' }}">
            </div>
            <div class="form-group col-md-5">
                <label>Image path</label>
                <input type="text" name="partner_logos[{{ $index }}][image]" class="form-control" value="{{ $logo['image'] ?? '' }}" placeholder="frontend/assets/img/logo/EMBLEM.png">
            </div>
            <div class="form-group col-md-4">
                <label>URL (optional)</label>
                <input type="url" name="partner_logos[{{ $index }}][url]" class="form-control" value="{{ $logo['url'] ?? '' }}">
            </div>
        </div>
    </div>
@endforeach

<hr><h5>Hero Background Images</h5>
@php
    $heroImages = old('hero_images', $heroImages ?? ['frontend/assets/img/hero1.jpg', 'frontend/assets/img/hero2.JPG', 'frontend/assets/img/hero3.jpg']);
@endphp
@foreach($heroImages as $index => $img)
    <div class="form-group">
        <label>Hero Image {{ $index + 1 }}</label>
        <input type="text" name="hero_images[{{ $index }}]" class="form-control" value="{{ $img }}">
    </div>
@endforeach
