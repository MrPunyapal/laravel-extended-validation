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
    public function __construct(array|string $allowed = [], array|string $blocked = [], public bool $allowSubdomains = false)
    {
        $this->allowed = array_values(array_map(strtolower(...), (array) $allowed));
        $this->blocked = array_values(array_map(strtolower(...), (array) $blocked));
    }

    /**
     * @param  array<int, string>|string  $allowed
     * @param  array<int, string>|string  $blocked
     */
    public static function make(array|string $allowed = [], array|string $blocked = [], bool $allowSubdomains = false): static
    {
        return new self($allowed, $blocked, $allowSubdomains);
    }

    public static function allowed(string ...$domains): static
    {
        return new self(allowed: array_values($domains));
    }

    public static function blocked(string ...$domains): static
    {
        return new self(blocked: array_values($domains));
    }

    public function allowSubdomains(bool $allow = true): static
    {
        $this->allowSubdomains = $allow;

        return $this;
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

        if ($this->allowed !== [] && ! $this->matchesDomain($domain, $this->allowed)) {
            $fail('extended-validation::validation.email_domain')->translate();

            return;
        }

        if ($this->blocked !== [] && $this->matchesDomain($domain, $this->blocked)) {
            $fail('extended-validation::validation.email_domain')->translate();
        }
    }

    /**
     * @param  list<string>  $list
     */
    private function matchesDomain(string $domain, array $list): bool
    {
        foreach ($list as $pattern) {
            if ($pattern === $domain) {
                return true;
            }

            if (str_starts_with($pattern, '*.')) {
                $root = substr($pattern, 2);
                if ($domain === $root || str_ends_with($domain, '.'.$root)) {
                    return true;
                }
            }

            if ($this->allowSubdomains && str_ends_with($domain, '.'.$pattern)) {
                return true;
            }
        }

        return false;
    }
}
