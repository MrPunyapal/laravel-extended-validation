<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Validator;
use MrPunyapal\LaravelExtendedValidation\Rules\MinWords;

describe('MinWords', function (): void {
    it('passes when word count meets minimum', function (): void {
        expect(Validator::make(
            ['bio' => 'This is a longer bio text with enough words'],
            ['bio' => new MinWords(5)]
        )->passes())->toBeTrue();
    });

    it('fails when word count is below minimum', function (): void {
        expect(Validator::make(
            ['bio' => 'Too short'],
            ['bio' => new MinWords(5)]
        )->fails())->toBeTrue();
    });
});
