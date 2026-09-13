<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Validator;
use MrPunyapal\LaravelExtendedValidation\Rules\MultipleOf;

describe('MultipleOf', function (): void {
    it('passes for integer multiples', function (mixed $value): void {
        expect(Validator::make(['num' => $value], ['num' => new MultipleOf(5)])->passes())->toBeTrue();
    })->with([
        5,
        10,
        15,
        0,
        -5,
        -100,
        '25',
    ]);

    it('fails for non-multiples', function (mixed $value): void {
        expect(Validator::make(['num' => $value], ['num' => new MultipleOf(5)])->fails())->toBeTrue();
    })->with([
        1,
        2,
        3,
        4,
        6,
        7.5,
        'not-a-number',
    ]);

    it('supports floating point steps', function (): void {
        $rule = new MultipleOf(0.25);

        expect(Validator::make(['price' => 0.50], ['price' => $rule])->passes())->toBeTrue();
        expect(Validator::make(['price' => 1.25], ['price' => $rule])->passes())->toBeTrue();
        expect(Validator::make(['price' => 2.00], ['price' => $rule])->passes())->toBeTrue();
        expect(Validator::make(['price' => 0.30], ['price' => $rule])->fails())->toBeTrue();
    });
});
