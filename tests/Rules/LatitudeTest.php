<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Validator;
use MrPunyapal\LaravelExtendedValidation\Rules\Latitude;

describe('Latitude', function (): void {
    it('passes for valid latitudes', function (int|float|string $value): void {
        expect(Validator::make(['lat' => $value], ['lat' => new Latitude])->passes())->toBeTrue();
    })->with([
        0,
        90,
        -90,
        45.123456,
        '-12.34',
        '89.9999',
    ]);

    it('fails for invalid latitudes', function (mixed $value): void {
        expect(Validator::make(['lat' => $value], ['lat' => new Latitude])->fails())->toBeTrue();
    })->with([
        90.1,
        -90.1,
        180,
        -180,
        'not-a-latitude',
        null,
    ]);
});
