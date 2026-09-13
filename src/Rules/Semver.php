<?php

declare(strict_types=1);

namespace MrPunyapal\LaravelExtendedValidation\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Traits\Conditionable;
use Illuminate\Support\Traits\Macroable;
use Illuminate\Translation\PotentiallyTranslatedString;

final class Semver implements ValidationRule
{
    use Conditionable, Macroable;

    public readonly string $mode;

    /**
     * Create a new rule instance.
     */
    public function __construct(string|bool|null $prefix = null)
    {
        $this->mode = match (is_bool($prefix) ? ($prefix ? 'required' : 'none') : strtolower(trim((string) $prefix))) {
            'v', 'prefix', 'required', '1', 'true' => 'required',
            'optional', 'any', 'maybe' => 'optional',
            default => 'none',
        };
    }

    /**
     * Create a new rule instance.
     */
    public static function make(string|bool|null $prefix = null): static
    {
        return new self($prefix);
    }

    public static function withPrefix(): static
    {
        return new self('required');
    }

    public static function optionalPrefix(): static
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
            $fail('laravel-extended-validation::validation.semver')->translate();

            return;
        }

        $corePattern = '(0|[1-9]\d*)\.(0|[1-9]\d*)\.(0|[1-9]\d*)(?:-((?:0|[1-9]\d*|\d*[a-zA-Z-][0-9a-zA-Z-]*)(?:\.(?:0|[1-9]\d*|\d*[a-zA-Z-][0-9a-zA-Z-]*))*))?(?:\+([0-9a-zA-Z-]+(?:\.[0-9a-zA-Z-]+)*))?';

        $pattern = match ($this->mode) {
            'required' => '/^v'.$corePattern.'$/',
            'optional' => '/^v?'.$corePattern.'$/',
            default => '/^'.$corePattern.'$/',
        };

        if (! preg_match($pattern, $value)) {
            $fail('laravel-extended-validation::validation.semver')->translate();
        }
    }
}
