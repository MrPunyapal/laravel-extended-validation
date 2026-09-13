<?php

declare(strict_types=1);

namespace MrPunyapal\LaravelExtendedValidation\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Traits\Conditionable;
use Illuminate\Support\Traits\Macroable;
use Illuminate\Translation\PotentiallyTranslatedString;

final class OddNumber implements ValidationRule
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
        if (! is_numeric($value) || abs((int) $value % 2) !== 1) {
            $fail('laravel-extended-validation::validation.odd')->translate();
        }
    }
}
