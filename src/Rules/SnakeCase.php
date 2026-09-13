<?php

declare(strict_types=1);

namespace MrPunyapal\LaravelExtendedValidation\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Traits\Conditionable;
use Illuminate\Support\Traits\Macroable;

final class SnakeCase implements ValidationRule
{
    use Conditionable, Macroable;

    public static function make(): static
    {
        return new self;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value)) {
            $fail('extended-validation::validation.snake_case')->translate();

            return;
        }

        if (preg_match('/^[a-z0-9]+(?:_[a-z0-9]+)*$/', $value) !== 1) {
            $fail('extended-validation::validation.snake_case')->translate();
        }
    }
}
