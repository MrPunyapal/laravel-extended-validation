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

    it('supports string-rule syntax and string parameters without type error', function (): void {
        expect(Validator::make(['val' => 5], ['val' => 'unless_between:10,20'])->passes())->toBeTrue();
        expect(Validator::make(['val' => 15], ['val' => 'unless_between:10,20'])->fails())->toBeTrue();
    });

    it('normalizes inverted bounds', function (): void {
        expect(Validator::make(['val' => 15], ['val' => new UnlessBetween(20, 10)])->fails())->toBeTrue();
        expect(Validator::make(['val' => 5], ['val' => new UnlessBetween(20, 10)])->passes())->toBeTrue();
    });

    it('fails for non-numeric values', function (): void {
        expect(Validator::make(['val' => 'abc'], ['val' => new UnlessBetween(10, 20)])->fails())->toBeTrue();
    });
});
