<?php

declare(strict_types=1);

namespace MrPunyapal\LaravelExtendedValidation\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Traits\Conditionable;
use Illuminate\Support\Traits\Macroable;

final class UnlessBetween implements ValidationRule
{
    use Conditionable, Macroable;

    public readonly int|float $min;

    public readonly int|float $max;

    public function __construct(int|float|string $min, int|float|string $max)
    {
        $val1 = is_numeric($min) ? (str_contains((string) $min, '.') ? (float) $min : (int) $min) : 0;
        $val2 = is_numeric($max) ? (str_contains((string) $max, '.') ? (float) $max : (int) $max) : 0;

        $this->min = min($val1, $val2);
        $this->max = max($val1, $val2);
    }

    public static function make(int|float|string $min, int|float|string $max): static
    {
        return new self($min, $max);
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_numeric($value)) {
            $fail('extended-validation::validation.unless_between')->translate([
                'min' => (string) $this->min,
                'max' => (string) $this->max,
            ]);

            return;
        }

        $num = (float) $value;

        if ($num >= $this->min && $num <= $this->max) {
            $fail('extended-validation::validation.unless_between')->translate([
                'min' => (string) $this->min,
                'max' => (string) $this->max,
            ]);
        }
    }
}
