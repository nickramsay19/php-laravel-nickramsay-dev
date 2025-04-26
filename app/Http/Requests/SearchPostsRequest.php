<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;

class SearchPostsRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array {
        return [
            'page' => ['sometimes', 'numeric', 'integer', 'min:1'],
            'per_page' => ['sometimes', 'numeric', 'integer', 'min:5'],
            'search' => ['sometimes', 'string'],
            'sort_by' => ['sometimes'],
            'slugs' => ['sometimes', 'list', 'filled'],
            'slugs.*' => ['string', 'exists:posts,slug'],
            'titles' => ['sometimes', 'list', 'filled'],
            'titles.*' => ['string', 'exists:posts,title'],
            'authors' => ['sometimes'],
            'published' => ['sometimes', 'boolean', 'filled', 'prohibits:published_after', 'prohibits:published_before'],
            'created_after' => ['sometimes', 'date'],
            'created_before' => [
                'sometimes', 
                'date', 
                Rule::when(isset($this->created_after), ['before:created_after']),
            ],
            'published_after' => ['sometimes', 'date'],
            'published_before' => [
                'sometimes', 
                'date', 
                Rule::when(isset($this->published_after), ['before:published_after']),
                Rule::when(isset($this->created_after), ['before:created_after']),
            ],
            'tags.*' => ['string', 'exists:tags,name'],
        ];
    }

    protected function prepareCommaDelimitedStringToArrayForValidation(string $field) {
        if ($this->get($field) && gettype($this->$field) == 'string') {
            $this->$field = array_filter(explode(',', $this->$field) ?? [], function ($segment) {
                return strlen($segment) > 0;
            });

            $this->merge([
                $field => $this->$field,
            ]);
        }
    }

    protected function prepareForValidation() {
        $this->prepareCommaDelimitedStringToArrayForValidation('sort_by');
        $this->prepareCommaDelimitedStringToArrayForValidation('slugs');
        $this->prepareCommaDelimitedStringToArrayForValidation('titles');
        $this->prepareCommaDelimitedStringToArrayForValidation('authors');
        $this->prepareCommaDelimitedStringToArrayForValidation('tags');
    }

    public function page(): int {
        return $this->input('page', 1);
    }

    public function perPage(): int {
        return $this->input('per_page', 15);
    }
}
