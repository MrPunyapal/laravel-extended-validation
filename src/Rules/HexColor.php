<?php

declare(strict_types=1);

namespace MrPunyapal\LaravelExtendedValidation\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Traits\Conditionable;
use Illuminate\Support\Traits\Macroable;
use Illuminate\Translation\PotentiallyTranslatedString;

final class HexColor implements ValidationRule
{
    use Conditionable, Macroable;

    public readonly string $mode;

    /**
     * Create a new rule instance.
     */
    public function __construct(string|bool|null $prefix = null)
    {
        $this->mode = match (is_bool($prefix) ? ($prefix ? 'required' : 'none') : strtolower(trim((string) $prefix))) {
            'no_hash', 'none', 'false', '0' => 'none',
            'optional', 'optional_hash', 'maybe', 'any' => 'optional',
            default => 'required',
        };
    }

    /**
     * Create a new rule instance.
     */
    public static function make(string|bool|null $prefix = null): static
    {
        return new self($prefix);
    }

    public static function withoutHash(): static
    {
        return new self('none');
    }

    public static function optionalHash(): static
    {
        return new self('optional');
    }

    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value)) {
            $fail('laravel-extended-validation::validation.hex_color')->translate();

            return;
        }

        $corePattern = '([A-Fa-f0-9]{3,4}|[A-Fa-f0-9]{6}|[A-Fa-f0-9]{8})';

        $pattern = match ($this->mode) {
            'none' => '/^'.$corePattern.'$/',
            'optional' => '/^#?'.$corePattern.'$/',
            default => '/^#'.$corePattern.'$/',
        };

        if (! preg_match($pattern, $value)) {
            $fail('laravel-extended-validation::validation.hex_color')->translate();
        }
    }
}
