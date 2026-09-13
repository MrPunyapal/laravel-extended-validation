<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Validator;
use MrPunyapal\LaravelExtendedValidation\Rules\Longitude;

describe('Longitude', function (): void {
    it('passes for valid longitudes', function (int|float|string $value): void {
        expect(Validator::make(['lng' => $value], ['lng' => new Longitude])->passes())->toBeTrue();
    })->with([
        0,
        180,
        -180,
        123.456,
        '-74.006',
        '179.9999',
    ]);

    it('fails for invalid longitudes', function (mixed $value): void {
        expect(Validator::make(['lng' => $value], ['lng' => new Longitude])->fails())->toBeTrue();
    })->with([
        180.1,
        -180.1,
        360,
        -360,
        'not-a-longitude',
        null,
    ]);
});
