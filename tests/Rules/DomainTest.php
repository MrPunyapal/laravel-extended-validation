<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Validator;
use MrPunyapal\LaravelExtendedValidation\Rules\Domain;

describe('Domain', function (): void {
    it('passes for valid domains', function (string $value): void {
        expect(Validator::make(['d' => $value], ['d' => new Domain])->passes())->toBeTrue();
    })->with([
        'example.com',
        'sub.example.com',
        'deep.sub.example.co.uk',
        'my-site.org',
    ]);

    it('fails for invalid domains', function (string $value): void {
        expect(Validator::make(['d' => $value], ['d' => new Domain])->fails())->toBeTrue();
    })->with([
        'http://example.com',
        '-example.com',
        'example-.com',
        '192.168.1.1',
        'localhost',
        '.com',
    ]);
});
