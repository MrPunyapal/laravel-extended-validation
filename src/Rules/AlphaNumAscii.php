<?php

declare(strict_types=1);

namespace MrPunyapal\LaravelExtendedValidation\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Traits\Conditionable;
use Illuminate\Support\Traits\Macroable;

final class AlphaNumAscii implements ValidationRule
{
    use Conditionable, Macroable;

    public static function make(): static
    {
        return new self;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value) && ! is_numeric($value)) {
            $fail('extended-validation::validation.alpha_num_ascii')->translate();

            return;
        }

        if (preg_match('/^[a-zA-Z0-9]+$/', (string) $value) !== 1) {
            $fail('extended-validation::validation.alpha_num_ascii')->translate();
        }
    }
}
