<?php

declare(strict_types=1);

namespace MrPunyapal\LaravelExtendedValidation\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Traits\Conditionable;
use Illuminate\Support\Traits\Macroable;
use Illuminate\Translation\PotentiallyTranslatedString;

final class E164Phone implements ValidationRule
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
            $fail('laravel-extended-validation::validation.e164')->translate();

            return;
        }

        if (! preg_match('/^\+[1-9]\d{1,14}$/', (string) $value)) {
            $fail('laravel-extended-validation::validation.e164')->translate();
        }
    }
}
