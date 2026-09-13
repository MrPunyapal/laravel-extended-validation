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

    public readonly bool $capital;

    public function __construct(bool|string $capital = false)
    {
        $this->capital = is_bool($capital)
            ? $capital
            : in_array(strtolower(trim($capital)), ['1', 'true', 'capital', 'caps', 'upper', 'uppercase', 'screaming'], true);
    }

    public static function make(bool|string $capital = false): static
    {
        return new self($capital);
    }

    public static function capital(): static
    {
        return new self(true);
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value)) {
            $fail('extended-validation::validation.snake_case')->translate();

            return;
        }

        $pattern = $this->capital
            ? '/^[A-Z0-9]+(?:_[A-Z0-9]+)*$/'
            : '/^[a-z0-9]+(?:_[a-z0-9]+)*$/';

        if (preg_match($pattern, $value) !== 1) {
            $fail('extended-validation::validation.snake_case')->translate();
        }
    }
}
