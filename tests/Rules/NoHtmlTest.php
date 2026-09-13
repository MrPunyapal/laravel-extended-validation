<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Validator;
use MrPunyapal\LaravelExtendedValidation\Rules\NoHtml;

describe('NoHtml', function (): void {
    it('passes for plain text without HTML tags', function (string $value): void {
        expect(Validator::make(['text' => $value], ['text' => new NoHtml])->passes())->toBeTrue();
    })->with([
        'plain text input',
        'Ben & Jerry\'s',
        'formula: 3 < 5 and 6 > 2',
        'hello world',
    ]);

    it('fails for strings containing HTML tags', function (mixed $value): void {
        expect(Validator::make(['text' => $value], ['text' => new NoHtml])->fails())->toBeTrue();
    })->with([
        '<p>hello</p>',
        '<b>bold</b>',
        '<script>alert("xss")</script>',
        '<img src="x" onerror="alert(1)">',
        null,
    ]);
});
