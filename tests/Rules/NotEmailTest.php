<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Validator;
use MrPunyapal\LaravelExtendedValidation\Rules\NotEmail;

describe('NotEmail', function (): void {
    it('passes for non-email strings', function (string $value): void {
        expect(Validator::make(['username' => $value], ['username' => new NotEmail])->passes())->toBeTrue();
    })->with([
        'johndoe',
        'my-username',
        'hello world',
        'not-an-email',
    ]);

    it('fails for valid email addresses', function (string $value): void {
        expect(Validator::make(['username' => $value], ['username' => new NotEmail])->fails())->toBeTrue();
    })->with([
        'user@example.com',
        'test@gmail.com',
        'a@b.co',
    ]);
});
