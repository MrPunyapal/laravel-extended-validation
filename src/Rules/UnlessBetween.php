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

    public function __construct(
        private readonly int|float $min,
        private readonly int|float $max,
    ) {}

    public static function make(int|float $min, int|float $max): static
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
