<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Validator;
use MrPunyapal\LaravelExtendedValidation\Rules\WithoutWhitespace;

describe('WithoutWhitespace', function (): void {
    it('passes for strings without whitespace', function (mixed $value): void {
        expect(Validator::make(['token' => $value], ['token' => new WithoutWhitespace])->passes())->toBeTrue();
    })->with([
        'username',
        'user_name-123',
        'token_without_space',
        '42',
        12345,
    ]);

    it('fails for strings containing whitespace', function (mixed $value): void {
        expect(Validator::make(['token' => $value], ['token' => new WithoutWhitespace])->fails())->toBeTrue();
    })->with([
        'hello world',
        "hello\tworld",
        "hello\nworld",
        ' leading_space',
        'trailing_space ',
        null,
    ]);
});
