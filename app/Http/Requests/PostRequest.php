<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Post;

class PostRequest extends Request {
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array {
        $required = $this->routeIs('posts.update') ? 'sometimes' : 'required';

        return [
            'title' => [$required, 'string'],
            'body' => [$required, 'string'],
            'tags' => ['sometimes', 'list', 'nullable'],
            'tags.*' => ['string'],
            'published' => ['sometimes', 'boolean'],
        ];
    }

    protected function prepareForValidation() {
        
    }
}
