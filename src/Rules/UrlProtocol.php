<?php

declare(strict_types=1);

namespace MrPunyapal\LaravelExtendedValidation\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Traits\Conditionable;
use Illuminate\Support\Traits\Macroable;

final class UrlProtocol implements ValidationRule
{
    use Conditionable, Macroable;

    /** @var list<string> */
    private readonly array $protocols;

    /**
     * @param  array<int, string>|string  ...$protocols
     */
    public function __construct(array|string ...$protocols)
    {
        $flattened = [];

        foreach ($protocols as $protocol) {
            if (is_array($protocol)) {
                $flattened = array_merge($flattened, $protocol);
            } else {
                $flattened[] = $protocol;
            }
        }

        $this->protocols = array_values(array_unique(array_map(
            fn (string $protocol): string => rtrim(strtolower(trim($protocol)), ':/'),
            $flattened
        )));
    }

    /**
     * @param  array<int, string>|string  ...$protocols
     */
    public static function make(array|string ...$protocols): static
    {
        return new self(...$protocols);
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value)) {
            $fail('extended-validation::validation.url_protocol')->translate([
                'protocols' => implode(', ', $this->protocols),
            ]);

            return;
        }

        $scheme = parse_url($value, PHP_URL_SCHEME);

        if (! is_string($scheme) || ! in_array(strtolower($scheme), $this->protocols, true)) {
            $fail('extended-validation::validation.url_protocol')->translate([
                'protocols' => implode(', ', $this->protocols),
            ]);
        }
    }
}
