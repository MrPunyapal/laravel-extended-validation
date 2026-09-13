<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Validator;
use MrPunyapal\LaravelExtendedValidation\Rules\UnlessBetween;

describe('UnlessBetween', function (): void {
    it('passes when value is outside the range', function (int|float $value): void {
        expect(Validator::make(['val' => $value], ['val' => new UnlessBetween(10, 20)])->passes())->toBeTrue();
    })->with([
        5,
        9.99,
        20.01,
        100,
        -5,
    ]);

    it('fails when value is inside the range', function (int|float $value): void {
        expect(Validator::make(['val' => $value], ['val' => new UnlessBetween(10, 20)])->fails())->toBeTrue();
    })->with([
        10,
        15,
        20,
        10.5,
    ]);
});
