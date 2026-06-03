<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class GalleryItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $imageRule = $this->isMethod('POST')
            ? ['required', 'image', 'mimes:png,jpg,jpeg,webp']
            : ['nullable', 'image', 'mimes:png,jpg,jpeg,webp'];

        return [
            'title' => ['nullable', 'string', 'max:255'],
            'image' => $imageRule,
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_published' => ['nullable', 'boolean'],
            'event_id' => ['nullable', 'exists:events,id'],
        ];
    }
}
