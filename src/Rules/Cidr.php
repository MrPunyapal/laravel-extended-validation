<?php

declare(strict_types=1);

namespace MrPunyapal\LaravelExtendedValidation\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Traits\Conditionable;
use Illuminate\Support\Traits\Macroable;

final class Cidr implements ValidationRule
{
    use Conditionable, Macroable;

    public function __construct(
        private readonly ?string $version = null,
    ) {}

    public static function make(?string $version = null): static
    {
        return new self($version);
    }

    public static function v4(): static
    {
        return new self('v4');
    }

    public static function v6(): static
    {
        return new self('v6');
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value)) {
            $fail('extended-validation::validation.cidr')->translate();

            return;
        }

        $parts = explode('/', $value);

        if (count($parts) !== 2) {
            $fail('extended-validation::validation.cidr')->translate();

            return;
        }

        [$ip, $mask] = $parts;

        if (! ctype_digit($mask)) {
            $fail('extended-validation::validation.cidr')->translate();

            return;
        }

        $maskInt = (int) $mask;
        $isV4 = filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) !== false;
        $isV6 = filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) !== false;

        if ($this->version === 'v4' || $this->version === '4') {
            if (! $isV4 || $maskInt < 0 || $maskInt > 32) {
                $fail('extended-validation::validation.cidr')->translate();
            }

            return;
        }

        if ($this->version === 'v6' || $this->version === '6') {
            if (! $isV6 || $maskInt < 0 || $maskInt > 128) {
                $fail('extended-validation::validation.cidr')->translate();
            }

            return;
        }

        $validV4 = $isV4 && $maskInt >= 0 && $maskInt <= 32;
        $validV6 = $isV6 && $maskInt >= 0 && $maskInt <= 128;

        if (! $validV4 && ! $validV6) {
            $fail('extended-validation::validation.cidr')->translate();
        }
    }
}
