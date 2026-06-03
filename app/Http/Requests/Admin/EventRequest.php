<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $imageRule = $this->isMethod('POST')
            ? ['nullable', 'image', 'mimes:png,jpg,jpeg,webp']
            : ['nullable', 'image', 'mimes:png,jpg,jpeg,webp'];

        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'location' => ['nullable', 'string', 'max:255'],
            'event_date' => ['required', 'date'],
            'image' => $imageRule,
            'is_published' => ['nullable', 'boolean'],
        ];
    }
}
