<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

use App\Models\Tag;

class TagRequest extends FormRequest {
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array {
        return [
            'name' => [
                'required', 
                'string', 
                'lowercase', 
                'alpha_num:ascii',  // e.g "tag_name", "tag-name", "my-tag"
                'unique:tags,name', 
                'not_in:create'     // prevent clash with the /tags/create route
            ],
        ];
    }
}
