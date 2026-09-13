<?php

declare(strict_types=1);

namespace MrPunyapal\LaravelExtendedValidation\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Traits\Conditionable;
use Illuminate\Support\Traits\Macroable;

final class AlphaUnderscore implements ValidationRule
{
    use Conditionable, Macroable;

    public function __construct(
        private readonly bool $ascii = false,
    ) {}

    public static function make(bool $ascii = false): static
    {
        return new self($ascii);
    }

    public static function ascii(): static
    {
        return new self(ascii: true);
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value) && ! is_numeric($value)) {
            $fail('extended-validation::validation.alpha_underscore')->translate();

            return;
        }

        $str = (string) $value;

        $pattern = $this->ascii
            ? '/^[a-zA-Z0-9_]+$/'
            : '/^[\pL\pM\pN_]+$/u';

        if (preg_match($pattern, $str) !== 1) {
            $fail('extended-validation::validation.alpha_underscore')->translate();
        }
    }
}
