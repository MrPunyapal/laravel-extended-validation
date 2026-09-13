<?php

declare(strict_types=1);

namespace MrPunyapal\LaravelExtendedValidation\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Traits\Conditionable;
use Illuminate\Support\Traits\Macroable;
use Illuminate\Translation\PotentiallyTranslatedString;

final class Domain implements ValidationRule
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
        if (! is_string($value)) {
            $fail('laravel-extended-validation::validation.domain')->translate();

            return;
        }

        if (strlen($value) > 253) {
            $fail('laravel-extended-validation::validation.domain')->translate();

            return;
        }

        if (filter_var($value, FILTER_VALIDATE_IP) !== false) {
            $fail('laravel-extended-validation::validation.domain')->translate();

            return;
        }

        if (! preg_match('/^(?!-)[A-Za-z0-9-]{1,63}(?<!-)(\.[A-Za-z0-9-]{1,63}(?<!-))*\.[A-Za-z]{2,}$/', $value)) {
            $fail('laravel-extended-validation::validation.domain')->translate();
        }
    }
}
