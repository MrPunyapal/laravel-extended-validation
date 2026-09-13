<?php

declare(strict_types=1);

namespace MrPunyapal\LaravelExtendedValidation\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Traits\Conditionable;
use Illuminate\Support\Traits\Macroable;
use Illuminate\Translation\PotentiallyTranslatedString;

final class Luhn implements ValidationRule
{
    use Conditionable, Macroable;

    /**
     * Create a new rule instance.
     */
    public function __construct() {}

    /**
     * Create a new rule instance.
     */
    public static function make(): static
    {
        return new self;
    }

    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value) && ! is_numeric($value)) {
            $fail('laravel-extended-validation::validation.luhn')->translate();

            return;
        }

        $digits = (string) preg_replace('/\D/', '', (string) $value);

        if ($digits === '' || ltrim($digits, '0') === '') {
            $fail('laravel-extended-validation::validation.luhn')->translate();

            return;
        }

        $sum = 0;
        $length = strlen($digits);
        $shouldDouble = false;

        for ($i = $length - 1; $i >= 0; $i--) {
            $digit = (int) $digits[$i];

            if ($shouldDouble) {
                $digit *= 2;

                if ($digit > 9) {
                    $digit -= 9;
                }
            }

            $sum += $digit;
            $shouldDouble = ! $shouldDouble;
        }

        if ($sum % 10 !== 0) {
            $fail('laravel-extended-validation::validation.luhn')->translate();
        }
    }
}
