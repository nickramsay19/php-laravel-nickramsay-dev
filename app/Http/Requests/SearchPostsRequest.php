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
            /*'slugs' => ['sometimes', 'list', 'filled'],
            'slugs.*' => ['string', 'exists:posts,slug'],
            'titles' => ['sometimes', 'list', 'filled'],
            'titles.*' => ['string', 'exists:posts,title'],
            'authors.*' => ['sometimes', 'list'],
            'authors.*' => ['string', 'exists:users,name'],*/

            'tags.*' => ['string', 'exists:tags,name'],
            /*'published' => ['sometimes', 'boolean', 'filled', 'prohibited_if:published_after', 'prohibited_if:published_before'],
            'created_after' => ['sometimes', 'date'],
            'created_before' => [
                'sometimes', 
                'date', 
                Rule::when(isset($this->created_after), ['before:created_after']),
            ],
            'published_after' => ['sometimes', 'date', 'prohibited'],
            'published_before' => [
                'sometimes', 
                'date', 
                Rule::when(isset($this->published_after), ['before:published_after']),
                Rule::when(isset($this->created_after), ['before:created_after']),
            ],
            'sort_by' => ['sometimes'],*/
        ];
    }

    protected function prepareForValidation() {
        if ($this->get('tags') && gettype($this->tags) == 'string') {
            $this->tags = array_filter(explode(',', $this->tags) ?? [], function ($tag) {
                return strlen($tag) > 0;
            });

            $this->merge([
                'tags' => $this->tags,
            ]);
        }
    }
}
