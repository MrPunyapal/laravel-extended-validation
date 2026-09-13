<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Validator;
use MrPunyapal\LaravelExtendedValidation\Rules\AlphaNumAscii;

describe('AlphaNumAscii', function (): void {
    it('passes for ascii alphanumeric strings', function (mixed $value): void {
        expect(Validator::make(['code' => $value], ['code' => new AlphaNumAscii])->passes())->toBeTrue();
    })->with([
        'abcXYZ123',
        'Username42',
        'ABC',
        '12345',
        999,
    ]);

    it('fails for strings with spaces, symbols, or non-ascii characters', function (mixed $value): void {
        expect(Validator::make(['code' => $value], ['code' => new AlphaNumAscii])->fails())->toBeTrue();
    })->with([
        'user_name',
        'user-name',
        'user name',
        'user@domain',
        'café',
        'über',
        'こんにちは',
        null,
    ]);
});
