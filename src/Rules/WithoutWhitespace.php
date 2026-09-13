<?php

declare(strict_types=1);

namespace MrPunyapal\LaravelExtendedValidation\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Traits\Conditionable;
use Illuminate\Support\Traits\Macroable;

final class WithoutWhitespace implements ValidationRule
{
    use Conditionable, Macroable;

    public static function make(): static
    {
        return new self;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value) && ! is_numeric($value)) {
            $fail('extended-validation::validation.without_whitespace')->translate();

            return;
        }

        if (preg_match('/\s/', (string) $value) === 1) {
            $fail('extended-validation::validation.without_whitespace')->translate();
        }
    }
}
