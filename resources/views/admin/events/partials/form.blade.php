<div class="form-group">
    <label>Title</label>
    <input type="text" name="title" class="form-control" value="{{ old('title', isset($event) ? $event->title : '') }}" required>
</div>
<div class="form-group">
    <label>Event Date</label>
    <input type="datetime-local" name="event_date" class="form-control"
        value="{{ old('event_date', isset($event) ? $event->event_date->format('Y-m-d\TH:i') : '') }}" required>
</div>
<div class="form-group">
    <label>Location</label>
    <input type="text" name="location" class="form-control" value="{{ old('location', isset($event) ? $event->location : '') }}">
</div>
<div class="form-group">
    <label>Image (optional)</label>
    <input type="file" name="image" class="form-control">
    @if(!empty($event?->image))
        <img src="{{ \Illuminate\Support\Facades\Storage::url($event->image) }}" alt="" style="max-height:120px;margin-top:.5rem;">
    @endif
</div>
<div class="form-group">
    <label>Description</label>
    <textarea name="description" id="description" class="form-control" rows="6">{{ old('description', isset($event) ? $event->description : '') }}</textarea>
</div>
<div class="form-group">
    <label><input type="checkbox" name="is_published" value="1" {{ old('is_published', isset($event) ? $event->is_published : true) ? 'checked' : '' }}> Published</label>
</div>
