<?php

declare(strict_types=1);

namespace MrPunyapal\LaravelExtendedValidation\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Traits\Conditionable;
use Illuminate\Support\Traits\Macroable;
use Illuminate\Translation\PotentiallyTranslatedString;

final class Isbn implements ValidationRule
{
    use Conditionable, Macroable;

    public readonly ?string $type;

    /**
     * Create a new rule instance.
     */
    public function __construct(string|int|null $type = null)
    {
        $this->type = $type !== null ? (string) $type : null;
    }

    /**
     * Create a new rule instance.
     */
    public static function make(string|int|null $type = null): static
    {
        return new self($type);
    }

    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value) && ! is_numeric($value)) {
            $fail('laravel-extended-validation::validation.isbn')->translate();

            return;
        }

        $isbn = strtoupper(str_replace(['-', ' '], '', (string) $value));

        $isValid = match ($this->type) {
            '10' => $this->validateIsbn10($isbn),
            '13' => $this->validateIsbn13($isbn),
            null => $this->validateIsbn10($isbn) || $this->validateIsbn13($isbn),
            default => false,
        };

        if (! $isValid) {
            $fail('laravel-extended-validation::validation.isbn')->translate();
        }
    }

    /**
     * Validate an ISBN-10 string.
     */
    private function validateIsbn10(string $isbn): bool
    {
        if (! preg_match('/^[0-9]{9}[0-9X]$/', $isbn)) {
            return false;
        }

        $sum = 0;
        for ($i = 0; $i < 9; $i++) {
            $sum += ((int) $isbn[$i]) * (10 - $i);
        }

        $sum += ($isbn[9] === 'X') ? 10 : (int) $isbn[9];

        return $sum % 11 === 0;
    }

    /**
     * Validate an ISBN-13 string.
     */
    private function validateIsbn13(string $isbn): bool
    {
        if (! preg_match('/^[0-9]{13}$/', $isbn)) {
            return false;
        }

        $sum = 0;
        for ($i = 0; $i < 13; $i++) {
            $weight = ($i % 2 === 0) ? 1 : 3;
            $sum += ((int) $isbn[$i]) * $weight;
        }

        return $sum % 10 === 0;
    }
}
