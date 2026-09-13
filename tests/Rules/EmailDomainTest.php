<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Validator;
use MrPunyapal\LaravelExtendedValidation\Rules\EmailDomain;

describe('EmailDomain', function (): void {
    it('passes when domain is in allowed list', function (): void {
        $rule = EmailDomain::allowed('company.com', 'partner.org');

        expect(Validator::make(['email' => 'user@company.com'], ['email' => $rule])->passes())->toBeTrue();
        expect(Validator::make(['email' => 'admin@partner.org'], ['email' => $rule])->passes())->toBeTrue();
        expect(Validator::make(['email' => 'user@gmail.com'], ['email' => $rule])->fails())->toBeTrue();
    });

    it('fails when domain is in blocked list', function (): void {
        $rule = EmailDomain::blocked('mailinator.com', 'tempmail.com');

        expect(Validator::make(['email' => 'user@gmail.com'], ['email' => $rule])->passes())->toBeTrue();
        expect(Validator::make(['email' => 'user@mailinator.com'], ['email' => $rule])->fails())->toBeTrue();
        expect(Validator::make(['email' => 'user@tempmail.com'], ['email' => $rule])->fails())->toBeTrue();
    });
});
