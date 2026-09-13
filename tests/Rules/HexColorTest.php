<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
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

    it('supports hex colors without hash prefix', function (): void {
        expect(Validator::make(['color' => 'ffffff'], ['color' => HexColor::withoutHash()])->passes())->toBeTrue();
        expect(Validator::make(['color' => '#ffffff'], ['color' => HexColor::withoutHash()])->fails())->toBeTrue();
        expect(Validator::make(['color' => 'ffffff'], ['color' => Rule::hexColor('no_hash')])->passes())->toBeTrue();
        expect(Validator::make(['color' => '#ffffff'], ['color' => Rule::hexColor('no_hash')])->fails())->toBeTrue();
    });

    it('supports optional hash prefix', function (): void {
        expect(Validator::make(['color' => '#ffffff'], ['color' => HexColor::optionalHash()])->passes())->toBeTrue();
        expect(Validator::make(['color' => 'ffffff'], ['color' => HexColor::optionalHash()])->passes())->toBeTrue();
        expect(Validator::make(['color' => '#ffffff'], ['color' => Rule::hexColor('optional_hash')])->passes())->toBeTrue();
        expect(Validator::make(['color' => 'ffffff'], ['color' => Rule::hexColor('optional_hash')])->passes())->toBeTrue();
        expect(Validator::make(['color' => 'invalid'], ['color' => HexColor::optionalHash()])->fails())->toBeTrue();
    });
});
