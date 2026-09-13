<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Validator;
use MrPunyapal\LaravelExtendedValidation\Rules\MaxWords;

describe('MaxWords', function (): void {
    it('passes when word count is within maximum', function (): void {
        expect(Validator::make(
            ['bio' => 'Short bio'],
            ['bio' => new MaxWords(5)]
        )->passes())->toBeTrue();
    });

    it('fails when word count exceeds maximum', function (): void {
        expect(Validator::make(
            ['bio' => 'This is a bio that has way too many words in it'],
            ['bio' => new MaxWords(5)]
        )->fails())->toBeTrue();
    });
});
