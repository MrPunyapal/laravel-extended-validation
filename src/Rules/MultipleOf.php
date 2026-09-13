<?php

declare(strict_types=1);

namespace MrPunyapal\LaravelExtendedValidation\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Traits\Conditionable;
use Illuminate\Support\Traits\Macroable;

final class MultipleOf implements ValidationRule
{
    use Conditionable, Macroable;

    public readonly int|float $step;

    public function __construct(int|float|string $step)
    {
        $this->step = is_numeric($step)
            ? (str_contains((string) $step, '.') ? (float) $step : (int) $step)
            : 0;
    }

    public static function make(int|float|string $step): static
    {
        return new self($step);
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_numeric($value) || $this->step == 0) {
            $fail('extended-validation::validation.multiple_of')->translate([
                'step' => $this->step,
            ]);

            return;
        }

        $val = (float) $value;
        $step = (float) $this->step;
        $quotient = $val / $step;

        if (abs($quotient - round($quotient)) > 1e-9) {
            $fail('extended-validation::validation.multiple_of')->translate([
                'step' => $this->step,
            ]);
        }
    }
}
