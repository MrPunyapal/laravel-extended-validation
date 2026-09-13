<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Validator;
use MrPunyapal\LaravelExtendedValidation\Rules\AlphaUnderscore;

describe('AlphaUnderscore', function (): void {
    it('passes for strings with letters, numbers, and underscores', function (string $value): void {
        expect(Validator::make(['u' => $value], ['u' => new AlphaUnderscore])->passes())->toBeTrue();
    })->with([
        'username',
        'user_name',
        'user_123',
        '_system_',
        'USER_NAME',
    ]);

    it('fails for strings with dashes, spaces, or special characters', function (mixed $value): void {
        expect(Validator::make(['u' => $value], ['u' => new AlphaUnderscore])->fails())->toBeTrue();
    })->with([
        'user-name',
        'user name',
        'user@name',
        'user.name',
        'user#name',
        null,
    ]);
});
