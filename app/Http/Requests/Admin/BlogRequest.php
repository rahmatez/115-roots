<?php

namespace App\Http\Requests\Admin;

use App\Models\Blog;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BlogRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $statusRule = ['required', Rule::in([Blog::STATUS_DRAFT, Blog::STATUS_PUBLISHED])];

        switch ($this->method()) {
            case 'POST':
                return [
                    'title' => 'required',
                    'excerpt' => 'required',
                    'image' => ['required', 'image', 'mimes:png,jpg,jpeg'],
                    'description' => 'required',
                    'category_id' => 'required',
                    'status' => $statusRule,
                    'published_at' => ['nullable', 'date'],
                    'meta_title' => ['nullable', 'string', 'max:255'],
                    'meta_description' => ['nullable', 'string', 'max:500'],
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'title' => 'required',
                    'excerpt' => 'required',
                    'image' => ['nullable', 'image', 'mimes:png,jpg,jpeg'],
                    'description' => 'required',
                    'category_id' => 'required',
                    'status' => $statusRule,
                    'published_at' => ['nullable', 'date'],
                    'meta_title' => ['nullable', 'string', 'max:255'],
                    'meta_description' => ['nullable', 'string', 'max:500'],
                ];
            default:
                return [];
        }
    }
}
