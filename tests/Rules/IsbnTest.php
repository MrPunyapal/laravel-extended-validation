<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Validator;
use MrPunyapal\LaravelExtendedValidation\Rules\Isbn;

describe('Isbn', function (): void {
    it('passes for valid ISBNs', function (string $value): void {
        expect(Validator::make(['isbn' => $value], ['isbn' => new Isbn])->passes())->toBeTrue();
    })->with([
        '0306406152',              // ISBN-10
        '978-0-306-40615-7',       // ISBN-13 with hyphens
        '9780306406157',           // ISBN-13 without hyphens
        '0-306-40615-2',           // ISBN-10 with hyphens
    ]);

    it('fails for invalid ISBNs', function (string $value): void {
        expect(Validator::make(['isbn' => $value], ['isbn' => new Isbn])->fails())->toBeTrue();
    })->with([
        '1234567890',
        '978-0-306-40615-0',       // wrong check digit
        'not-an-isbn',
    ]);

    it('validates only ISBN-10 when specified', function (): void {
        $rule = new Isbn('10');
        expect(Validator::make(['isbn' => '0306406152'], ['isbn' => $rule])->passes())->toBeTrue();
        expect(Validator::make(['isbn' => '9780306406157'], ['isbn' => $rule])->fails())->toBeTrue();
    });

    it('validates only ISBN-13 when specified', function (): void {
        $rule = new Isbn('13');
        expect(Validator::make(['isbn' => '9780306406157'], ['isbn' => $rule])->passes())->toBeTrue();
        expect(Validator::make(['isbn' => '0306406152'], ['isbn' => $rule])->fails())->toBeTrue();
    });

    it('supports static factory methods', function (): void {
        expect(Validator::make(['isbn' => '0306406152'], ['isbn' => Isbn::isbn10()])->passes())->toBeTrue();
        expect(Validator::make(['isbn' => '9780306406157'], ['isbn' => Isbn::isbn10()])->fails())->toBeTrue();
        expect(Validator::make(['isbn' => '9780306406157'], ['isbn' => Isbn::isbn13()])->passes())->toBeTrue();
        expect(Validator::make(['isbn' => '0306406152'], ['isbn' => Isbn::isbn13()])->fails())->toBeTrue();
    });
});
