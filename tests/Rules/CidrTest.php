<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Validator;
use MrPunyapal\LaravelExtendedValidation\Rules\Cidr;

describe('Cidr', function (): void {
    it('passes for valid CIDR notations', function (string $value): void {
        expect(Validator::make(['cidr' => $value], ['cidr' => new Cidr])->passes())->toBeTrue();
    })->with([
        '192.168.1.0/24',
        '10.0.0.0/8',
        '0.0.0.0/0',
        '172.16.0.0/16',
        '2001:db8::/32',
        '::1/128',
    ]);

    it('fails for invalid CIDR notations', function (mixed $value): void {
        expect(Validator::make(['cidr' => $value], ['cidr' => new Cidr])->fails())->toBeTrue();
    })->with([
        '192.168.1.0/33',
        '192.168.1.0',
        '192.168.1.256/24',
        'not-a-cidr',
        '2001:db8::/129',
        123,
    ]);

    it('supports v4 specific validation', function (): void {
        expect(Validator::make(['c' => '10.0.0.0/8'], ['c' => Cidr::v4()])->passes())->toBeTrue();
        expect(Validator::make(['c' => '2001:db8::/32'], ['c' => Cidr::v4()])->fails())->toBeTrue();
    });

    it('supports v6 specific validation', function (): void {
        expect(Validator::make(['c' => '2001:db8::/32'], ['c' => Cidr::v6()])->passes())->toBeTrue();
        expect(Validator::make(['c' => '10.0.0.0/8'], ['c' => Cidr::v6()])->fails())->toBeTrue();
    });
});
