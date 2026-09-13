<?php

declare(strict_types=1);

namespace MrPunyapal\LaravelExtendedValidation\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Traits\Conditionable;
use Illuminate\Support\Traits\Macroable;

final class Longitude implements ValidationRule
{
    use Conditionable, Macroable;

    public static function make(): static
    {
        return new self;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_numeric($value)) {
            $fail('extended-validation::validation.longitude')->translate();

            return;
        }

        $lng = (float) $value;

        if ($lng < -180.0 || $lng > 180.0) {
            $fail('extended-validation::validation.longitude')->translate();
        }
    }
}
