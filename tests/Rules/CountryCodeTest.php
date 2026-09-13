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

    it('supports alpha-3 codes', function (): void {
        expect(Validator::make(['cc' => 'USA'], ['cc' => CountryCode::alpha3()])->passes())->toBeTrue();
        expect(Validator::make(['cc' => 'US'], ['cc' => CountryCode::alpha3()])->fails())->toBeTrue();
        expect(Validator::make(['cc' => 'USA'], ['cc' => 'country_code:alpha3'])->passes())->toBeTrue();
    });

    it('supports any format accepting alpha2 or alpha3', function (): void {
        expect(Validator::make(['cc' => 'US'], ['cc' => CountryCode::any()])->passes())->toBeTrue();
        expect(Validator::make(['cc' => 'USA'], ['cc' => CountryCode::any()])->passes())->toBeTrue();
        expect(Validator::make(['cc' => 'US'], ['cc' => 'country_code:any'])->passes())->toBeTrue();
        expect(Validator::make(['cc' => 'USA'], ['cc' => 'country_code:any'])->passes())->toBeTrue();
        expect(Validator::make(['cc' => 'INVALID'], ['cc' => CountryCode::any()])->fails())->toBeTrue();
    });
});
