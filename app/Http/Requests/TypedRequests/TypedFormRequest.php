<?php

namespace App\Http\Requests\TypedRequests;

use Illuminate\Foundation\Http\FormRequest;

class TypedFormRequest extends FormRequest {
    public function validate(array $rules = null, ...$params) {
        \Log::info($rules);
        \Log::info($params);

        


        $validated = self::validate($rules ?? $this->rules(), ...$params);
        return $this->applyTransformations($validated);
    }

    protected function applyTransformations(array $validated) {
        if (method_exists($this, 'casts')) {
            foreach ($this->casts() as $key => $cast) {
                if (isset($validated[$key])) {
                    $validated[$key] = $this->castValue($validated[$key], $cast);
                }
            }
        }
        return $validated;
    }

    private function castValue($value, string $castType) {
        return match ($castType) {
            'int' => (int) $value,
            'float' => (float) $value,
            'bool' => filter_var($value, FILTER_VALIDATE_BOOLEAN),
            'string' => (string) $value,
            'array' => (array) $value,
            'date' => \Carbon\Carbon::parse($value),
            default => $value,
        };
    }
}