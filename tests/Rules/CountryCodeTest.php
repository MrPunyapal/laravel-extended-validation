<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Validator;
use MrPunyapal\LaravelExtendedValidation\Rules\CountryCode;

describe('CountryCode', function (): void {
    it('passes for valid alpha-2 codes', function (string $value): void {
        expect(Validator::make(['cc' => $value], ['cc' => new CountryCode])->passes())->toBeTrue();
    })->with(['US', 'GB', 'IN', 'DE', 'JP']);

    it('fails for invalid alpha-2 codes', function (string $value): void {
        expect(Validator::make(['cc' => $value], ['cc' => new CountryCode])->fails())->toBeTrue();
    })->with(['XX', 'ZZ', 'USA', '12']);

    it('is case insensitive', function (): void {
        expect(Validator::make(['cc' => 'us'], ['cc' => new CountryCode])->passes())->toBeTrue();
    });
});
