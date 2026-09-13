<?php

declare(strict_types=1);

namespace MrPunyapal\LaravelExtendedValidation\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Traits\Conditionable;
use Illuminate\Support\Traits\Macroable;

final class Latitude implements ValidationRule
{
    use Conditionable, Macroable;

    public static function make(): static
    {
        return new self;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_numeric($value)) {
            $fail('extended-validation::validation.latitude')->translate();

            return;
        }

        $lat = (float) $value;

        if ($lat < -90.0 || $lat > 90.0) {
            $fail('extended-validation::validation.latitude')->translate();
        }
    }
}
