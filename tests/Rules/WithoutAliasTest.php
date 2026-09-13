<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Validator;
use MrPunyapal\LaravelExtendedValidation\Rules\WithoutAlias;

describe('WithoutAlias', function (): void {
    it('passes for emails without aliases', function (string $value): void {
        expect(Validator::make(['email' => $value], ['email' => new WithoutAlias])->passes())->toBeTrue();
    })->with([
        'user@example.com',
        'john.doe@gmail.com',
        'test@sub.domain.co.uk',
    ]);

    it('fails for emails with plus aliases', function (string $value): void {
        expect(Validator::make(['email' => $value], ['email' => new WithoutAlias])->fails())->toBeTrue();
    })->with([
        'user+alias@example.com',
        'john+test@gmail.com',
        '+user@example.com',
        'user+@example.com',
    ]);
});
