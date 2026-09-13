<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Validator;
use MrPunyapal\LaravelExtendedValidation\Rules\Semver;

describe('Semver', function (): void {
    it('passes for valid semver strings', function (string $value): void {
        expect(Validator::make(['v' => $value], ['v' => new Semver])->passes())->toBeTrue();
    })->with([
        '0.0.0',
        '1.0.0',
        '1.2.3',
        '10.20.30',
        '1.0.0-alpha',
        '1.0.0-alpha.1',
        '1.0.0-0.3.7',
        '1.0.0-x.7.z.92',
        '1.0.0+build.1',
        '1.0.0-beta+build.123',
    ]);

    it('fails for invalid semver strings', function (string $value): void {
        expect(Validator::make(['v' => $value], ['v' => new Semver])->fails())->toBeTrue();
    })->with([
        'v1.0.0',
        '1.0',
        '1',
        '1.0.0.0',
        '01.0.0',
        '1.02.0',
        '1.0.03',
    ]);

    it('supports required v prefix mode', function (): void {
        expect(Validator::make(['v' => 'v1.2.3'], ['v' => Semver::withPrefix()])->passes())->toBeTrue();
        expect(Validator::make(['v' => '1.2.3'], ['v' => Semver::withPrefix()])->fails())->toBeTrue();
        expect(Validator::make(['v' => 'v1.2.3'], ['v' => 'semver:v'])->passes())->toBeTrue();
        expect(Validator::make(['v' => '1.2.3'], ['v' => 'semver:v'])->fails())->toBeTrue();
    });

    it('supports optional v prefix mode', function (): void {
        expect(Validator::make(['v' => 'v1.2.3'], ['v' => Semver::optionalPrefix()])->passes())->toBeTrue();
        expect(Validator::make(['v' => '1.2.3'], ['v' => Semver::optionalPrefix()])->passes())->toBeTrue();
        expect(Validator::make(['v' => 'v1.2.3'], ['v' => 'semver:optional'])->passes())->toBeTrue();
        expect(Validator::make(['v' => '1.2.3'], ['v' => 'semver:optional'])->passes())->toBeTrue();
        expect(Validator::make(['v' => 'invalid'], ['v' => Semver::optionalPrefix()])->fails())->toBeTrue();
    });
});
