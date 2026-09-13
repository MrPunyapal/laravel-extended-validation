<?php

declare(strict_types=1);

namespace MrPunyapal\LaravelExtendedValidation\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Traits\Conditionable;
use Illuminate\Support\Traits\Macroable;

final class EmailDomain implements ValidationRule
{
    use Conditionable, Macroable;

    /** @var list<string> */
    private readonly array $allowed;

    /** @var list<string> */
    private readonly array $blocked;

    /**
     * @param  array<int, string>|string  $allowed
     * @param  array<int, string>|string  $blocked
     */
    public function __construct(array|string $allowed = [], array|string $blocked = [])
    {
        $this->allowed = array_values(array_map(strtolower(...), (array) $allowed));
        $this->blocked = array_values(array_map(strtolower(...), (array) $blocked));
    }

    /**
     * @param  array<int, string>|string  $allowed
     * @param  array<int, string>|string  $blocked
     */
    public static function make(array|string $allowed = [], array|string $blocked = []): static
    {
        return new self($allowed, $blocked);
    }

    public static function allowed(string ...$domains): static
    {
        return new self(allowed: array_values($domains));
    }

    public static function blocked(string ...$domains): static
    {
        return new self(blocked: array_values($domains));
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value) || ! str_contains($value, '@')) {
            $fail('extended-validation::validation.email_domain')->translate();

            return;
        }

        $domain = strtolower(substr(strrchr($value, '@') ?: '', 1));

        if ($domain === '') {
            $fail('extended-validation::validation.email_domain')->translate();

            return;
        }

        if ($this->allowed !== [] && ! in_array($domain, $this->allowed, true)) {
            $fail('extended-validation::validation.email_domain')->translate();

            return;
        }

        if ($this->blocked !== [] && in_array($domain, $this->blocked, true)) {
            $fail('extended-validation::validation.email_domain')->translate();
        }
    }
}
