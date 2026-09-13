<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Validator;
use MrPunyapal\LaravelExtendedValidation\Rules\Base64String;

describe('Base64String', function (): void {
    it('passes for valid base64 strings', function (string $value): void {
        expect(Validator::make(['data' => $value], ['data' => new Base64String])->passes())->toBeTrue();
    })->with([
        'SGVsbG8gV29ybGQ=',       // "Hello World"
        'dGVzdA==',                 // "test"
        'YQ==',                     // "a"
    ]);

    it('fails for invalid base64 strings', function (mixed $value): void {
        expect(Validator::make(['data' => $value], ['data' => new Base64String])->fails())->toBeTrue();
    })->with([
        'not-valid-base64!!!',
        '',
        123,
    ]);

    it('validates data URI with mime types', function (): void {
        $rule = new Base64String('image/png', 'image/jpeg');
        $valid = 'data:image/png;base64,iVBORw0KGgo=';

        expect(Validator::make(['img' => $valid], ['img' => $rule])->passes())->toBeTrue();
    });

    it('supports url-safe base64 strings', function (): void {
        // "Hello?World" base64 is "SGVsbG8/V29ybGQ=" -> urlsafe is "SGVsbG8_V29ybGQ"
        $urlSafeString = 'SGVsbG8_V29ybGQ';

        expect(Validator::make(['token' => $urlSafeString], ['token' => Base64String::urlSafe()])->passes())->toBeTrue();
        expect(Validator::make(['token' => $urlSafeString], ['token' => 'base64_string:url_safe'])->passes())->toBeTrue();
        expect(Validator::make(['token' => 'not-valid-base64!!!'], ['token' => Base64String::urlSafe()])->fails())->toBeTrue();
    });
});
