<?php

declare(strict_types=1);

namespace MrPunyapal\LaravelExtendedValidation\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Traits\Conditionable;
use Illuminate\Support\Traits\Macroable;
use Illuminate\Translation\PotentiallyTranslatedString;

final class Base64String implements ValidationRule
{
    use Conditionable, Macroable;

    public bool $implicit = true;

    public bool $urlSafe = false;

    /**
     * @var array<int, string>
     */
    protected readonly array $allowedMimeTypes;

    /**
     * Create a new rule instance.
     *
     * @param  array<int, string>|string|bool  $allowedMimeTypes
     */
    public function __construct(
        array|string|bool $allowedMimeTypes = [],
        string|bool ...$additionalArgs,
    ) {
        if ($allowedMimeTypes === true || $allowedMimeTypes === 'url_safe') {
            $this->allowedMimeTypes = [];
            $this->urlSafe = true;

            return;
        }

        $types = is_array($allowedMimeTypes) ? $allowedMimeTypes : [$allowedMimeTypes];
        $flattened = array_merge($types, $additionalArgs);
        $mimeTypes = [];

        foreach ($flattened as $arg) {
            if ($arg === true || $arg === 'url_safe') {
                $this->urlSafe = true;
            } elseif (is_string($arg) && $arg !== '') {
                $mimeTypes[] = $arg;
            }
        }

        $this->allowedMimeTypes = array_values(array_filter($mimeTypes));
    }

    /**
     * Create a new rule instance.
     *
     * @param  array<int, string>|string|bool  $allowedMimeTypes
     */
    public static function make(array|string|bool $allowedMimeTypes = [], string|bool ...$additionalArgs): static
    {
        return new self($allowedMimeTypes, ...$additionalArgs);
    }

    public static function urlSafe(): static
    {
        return new self('url_safe');
    }

    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value) || $value === '') {
            $fail('laravel-extended-validation::validation.base64_string')->translate();

            return;
        }

        $base64 = $value;

        if (str_starts_with($value, 'data:')) {
            if (! preg_match('/^data:([a-zA-Z0-9]+\/[a-zA-Z0-9\-\+\.]+)?;base64,(.+)$/', $value, $matches)) {
                $fail('laravel-extended-validation::validation.base64_string')->translate();

                return;
            }

            if (! empty($this->allowedMimeTypes) && ! in_array($matches[1], $this->allowedMimeTypes, true)) {
                $fail('laravel-extended-validation::validation.base64_string')->translate();

                return;
            }

            $base64 = $matches[2];
        } elseif (! empty($this->allowedMimeTypes)) {
            $fail('laravel-extended-validation::validation.base64_string')->translate();

            return;
        }

        if ($this->urlSafe) {
            $standard = strtr($base64, '-_', '+/');
            $remainder = strlen($standard) % 4;
            if ($remainder > 0) {
                $standard .= str_repeat('=', 4 - $remainder);
            }

            $decoded = base64_decode($standard, true);

            if ($decoded === false || strtr(rtrim(base64_encode($decoded), '='), '+/', '-_') !== rtrim($base64, '=')) {
                $fail('laravel-extended-validation::validation.base64_string')->translate();
            }

            return;
        }

        $decoded = base64_decode($base64, true);

        if ($decoded === false || base64_encode($decoded) !== $base64) {
            $fail('laravel-extended-validation::validation.base64_string')->translate();
        }
    }
}
