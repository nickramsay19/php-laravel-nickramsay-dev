<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;

use TypedRequests\TypedFormRequest;

use App\Models\Post;

class HomeRequest extends TypedFormRequest {
    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'test' => ['sometimes', 'boolean', 'casts:bool'],
        ];
    }
}
