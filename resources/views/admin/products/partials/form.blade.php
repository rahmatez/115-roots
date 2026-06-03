<div class="form-group">
    <label>Name</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', isset($product) ? $product->name : '') }}" required>
</div>
<div class="form-group">
    <label>Category</label>
    <input type="text" name="category" class="form-control" value="{{ old('category', isset($product) ? $product->category : '') }}" placeholder="Merchandise, Apparel, etc.">
</div>
<div class="form-row">
    <div class="form-group col-md-8">
        <label>Price</label>
        <input type="number" name="price" class="form-control" value="{{ old('price', isset($product) ? $product->price : '') }}" min="0" step="1" required>
    </div>
    <div class="form-group col-md-4">
        <label>Currency</label>
        <input type="text" name="currency" class="form-control" value="{{ old('currency', isset($product) ? $product->currency : 'IDR') }}">
    </div>
</div>
<div class="form-group">
    <label>Image @if(!isset($product))<span class="text-danger">*</span>@endif</label>
    <input type="file" name="image" class="form-control" {{ isset($product) ? '' : 'required' }}>
    @if(!empty($product?->image))
        <img src="{{ $product->imageUrl() }}" alt="" style="max-height:100px;margin-top:.5rem;">
    @endif
</div>
<div class="form-group">
    <label>External URL (Shopee, Tokopedia, etc.)</label>
    <input type="url" name="external_url" class="form-control" value="{{ old('external_url', isset($product) ? $product->external_url : '') }}">
</div>
<div class="form-group">
    <label>Description</label>
    <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', isset($product) ? $product->description : '') }}</textarea>
</div>
<div class="form-group">
    <label>Sort Order</label>
    <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', isset($product) ? $product->sort_order : 0) }}" min="0">
</div>
<div class="form-group">
    <label><input type="checkbox" name="is_published" value="1" {{ old('is_published', isset($product) ? $product->is_published : true) ? 'checked' : '' }}> Published</label>
</div>
