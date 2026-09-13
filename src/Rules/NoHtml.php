<?php

declare(strict_types=1);

namespace MrPunyapal\LaravelExtendedValidation\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Traits\Conditionable;
use Illuminate\Support\Traits\Macroable;

final class NoHtml implements ValidationRule
{
    use Conditionable, Macroable;

    public static function make(): static
    {
        return new self;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value)) {
            $fail('extended-validation::validation.no_html')->translate();

            return;
        }

        if (strip_tags($value) !== $value) {
            $fail('extended-validation::validation.no_html')->translate();
        }
    }
}
