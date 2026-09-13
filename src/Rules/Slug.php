<?php

declare(strict_types=1);

namespace MrPunyapal\LaravelExtendedValidation\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Traits\Conditionable;
use Illuminate\Support\Traits\Macroable;
use Illuminate\Translation\PotentiallyTranslatedString;

final class Slug implements ValidationRule
{
    use Conditionable, Macroable;

    /**
     * Create a new rule instance.
     */
    public function __construct(
        protected string $separator = '-',
    ) {}

    /**
     * Create a new rule instance.
     */
    public static function make(string $separator = '-'): static
    {
        return new self($separator);
    }

    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value)) {
            $fail('laravel-extended-validation::validation.slug')->translate();

            return;
        }

        $separator = preg_quote($this->separator, '/');

        if (! preg_match('/^[a-z0-9]+(?:'.$separator.'[a-z0-9]+)*$/', $value)) {
            $fail('laravel-extended-validation::validation.slug')->translate();
        }
    }
}
