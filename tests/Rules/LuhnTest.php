<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Validator;
use MrPunyapal\LaravelExtendedValidation\Rules\Luhn;

describe('Luhn', function (): void {
    it('passes for valid Luhn numbers', function (string $value): void {
        expect(Validator::make(['cc' => $value], ['cc' => new Luhn])->passes())->toBeTrue();
    })->with([
        '4111111111111111',   // Visa test
        '5500000000000004',   // Mastercard test
        '378282246310005',    // Amex test
        '79927398713',        // Known valid
        '7992-7398-713',      // Hyphenated
        '7992 7398 713',      // Spaced
    ]);

    it('fails for invalid Luhn numbers', function (string $value): void {
        expect(Validator::make(['cc' => $value], ['cc' => new Luhn])->fails())->toBeTrue();
    })->with([
        '1234567890123456',
        '0000000000000000',
        'abcdefg',
        'abc79927398713xyz',
        '79927398713!',
    ]);
});
