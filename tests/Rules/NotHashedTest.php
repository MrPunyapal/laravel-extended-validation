<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Validator;
use MrPunyapal\LaravelExtendedValidation\Rules\NotHashed;

describe('NotHashed', function (): void {
    it('passes for plain text strings', function (string $value): void {
        expect(Validator::make(['pw' => $value], ['pw' => new NotHashed])->passes())->toBeTrue();
    })->with([
        'my-secret-password',
        'P@ssw0rd123!',
        'plain-text',
    ]);

    it('fails for hashed password strings', function (): void {
        $bcrypt = password_hash('secret', PASSWORD_BCRYPT);
        expect(Validator::make(['pw' => $bcrypt], ['pw' => new NotHashed])->fails())->toBeTrue();
    });
});
