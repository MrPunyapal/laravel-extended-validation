<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Validator;
use MrPunyapal\LaravelExtendedValidation\Rules\OddNumber;

describe('OddNumber', function (): void {
    it('passes for odd numbers', function (mixed $value): void {
        expect(Validator::make(['num' => $value], ['num' => new OddNumber])->passes())->toBeTrue();
    })->with([1, 3, -1, 99, '7']);

    it('fails for even numbers', function (mixed $value): void {
        expect(Validator::make(['num' => $value], ['num' => new OddNumber])->fails())->toBeTrue();
    })->with([0, 2, 4, -2, 100, '42']);

    it('fails for non-numeric values', function (): void {
        expect(Validator::make(['num' => 'abc'], ['num' => new OddNumber])->fails())->toBeTrue();
    });
});
