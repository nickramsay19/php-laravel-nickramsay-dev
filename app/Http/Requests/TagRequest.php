<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Tag;

class TagRequest extends Request {
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
                'alpha_num:ascii',  // e.g "tag_name", "tag-name", "my-tag-2"
                'unique:tags,name', 
                'not_in:create'     // prevent clash with the /tags/create route
            ],
        ];
    }
}
