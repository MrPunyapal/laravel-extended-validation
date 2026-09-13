<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Validator;
use MrPunyapal\LaravelExtendedValidation\Rules\E164Phone;

describe('E164Phone', function (): void {
    it('passes for valid E.164 numbers', function (string $value): void {
        expect(Validator::make(['phone' => $value], ['phone' => new E164Phone])->passes())->toBeTrue();
    })->with([
        '+14155552671',
        '+442071234567',
        '+919876543210',
        '+12',
    ]);

    it('fails for invalid E.164 numbers', function (string $value): void {
        expect(Validator::make(['phone' => $value], ['phone' => new E164Phone])->fails())->toBeTrue();
    })->with([
        '14155552671',            // missing +
        '+0123456789',            // starts with 0
        '+1234567890123456',      // too long (16 digits)
        '+1',                     // too short
        'not-a-phone',
    ]);
});
