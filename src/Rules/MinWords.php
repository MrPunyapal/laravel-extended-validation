<?php

declare(strict_types=1);

namespace MrPunyapal\LaravelExtendedValidation\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Traits\Conditionable;
use Illuminate\Support\Traits\Macroable;
use Illuminate\Translation\PotentiallyTranslatedString;

final class MinWords implements ValidationRule
{
    use Conditionable, Macroable;

    public readonly int $min;

    /**
     * Create a new rule instance.
     */
    public function __construct(int|string $min)
    {
        $this->min = (int) $min;
    }

    /**
     * Create a new rule instance.
     */
    public static function make(int|string $min): static
    {
        return new self($min);
    }

    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value) && ! is_numeric($value)) {
            $fail('laravel-extended-validation::validation.min_words')->translate(['min' => (string) $this->min]);

            return;
        }

        $wordCount = str_word_count(strip_tags((string) $value));

        if ($wordCount < $this->min) {
            $fail('laravel-extended-validation::validation.min_words')->translate(['min' => (string) $this->min]);
        }
    }
}
