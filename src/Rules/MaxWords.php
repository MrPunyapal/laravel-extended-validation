<?php

declare(strict_types=1);

namespace MrPunyapal\LaravelExtendedValidation\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Traits\Conditionable;
use Illuminate\Support\Traits\Macroable;
use Illuminate\Translation\PotentiallyTranslatedString;

final class MaxWords implements ValidationRule
{
    use Conditionable, Macroable;

    public readonly int $max;

    /**
     * Create a new rule instance.
     */
    public function __construct(int|string $max)
    {
        $this->max = (int) $max;
    }

    /**
     * Create a new rule instance.
     */
    public static function make(int|string $max): static
    {
        return new self($max);
    }

    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value) && ! is_numeric($value)) {
            $fail('laravel-extended-validation::validation.max_words')->translate(['max' => (string) $this->max]);

            return;
        }

        $wordCount = str_word_count(strip_tags((string) $value));

        if ($wordCount > $this->max) {
            $fail('laravel-extended-validation::validation.max_words')->translate(['max' => (string) $this->max]);
        }
    }
}
