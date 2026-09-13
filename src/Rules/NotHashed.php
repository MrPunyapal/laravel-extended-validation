<?php

declare(strict_types=1);

namespace MrPunyapal\LaravelExtendedValidation\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Traits\Conditionable;
use Illuminate\Support\Traits\Macroable;

final class NotHashed implements ValidationRule
{
    use Conditionable, Macroable;

    public static function make(): static
    {
        return new self;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value)) {
            $fail('extended-validation::validation.not_hashed')->translate();

            return;
        }

        $info = password_get_info($value);

        if ($info['algoName'] !== 'unknown') {
            $fail('extended-validation::validation.not_hashed')->translate();
        }
    }
}
