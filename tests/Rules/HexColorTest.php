<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Validator;
use MrPunyapal\LaravelExtendedValidation\Rules\HexColor;

describe('HexColor', function (): void {
    it('passes for valid hex colors', function (string $value): void {
        expect(Validator::make(['color' => $value], ['color' => new HexColor])->passes())->toBeTrue();
    })->with([
        '#fff',
        '#FFF',
        '#ffffff',
        '#FFFFFF',
        '#ff00ff',
        '#ffff',
        '#ffffffff',
    ]);

    it('fails for invalid hex colors', function (string $value): void {
        expect(Validator::make(['color' => $value], ['color' => new HexColor])->fails())->toBeTrue();
    })->with([
        'fff',
        '#ff',
        '#fffff',
        '#gggggg',
        'red',
        '#fffffff',
    ]);
});
