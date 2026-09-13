<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Validator;
use MrPunyapal\LaravelExtendedValidation\Rules\Slug;

describe('Slug', function (): void {
    it('passes for valid slugs', function (string $value): void {
        expect(Validator::make(['slug' => $value], ['slug' => new Slug])->passes())->toBeTrue();
    })->with([
        'simple slug' => 'hello-world',
        'single word' => 'hello',
        'numbers' => '123',
        'mixed' => 'hello-world-123',
    ]);

    it('fails for invalid slugs', function (string $value): void {
        expect(Validator::make(['slug' => $value], ['slug' => new Slug])->fails())->toBeTrue();
    })->with([
        'uppercase' => 'Hello-World',
        'spaces' => 'hello world',
        'special chars' => 'hello@world',
        'consecutive dashes' => 'hello--world',
        'leading dash' => '-hello',
        'trailing dash' => 'hello-',
    ]);

    it('supports custom separator', function (): void {
        expect(Validator::make(['slug' => 'hello_world'], ['slug' => new Slug('_')])->passes())->toBeTrue();
        expect(Validator::make(['slug' => 'hello-world'], ['slug' => new Slug('_')])->fails())->toBeTrue();
    });

    it('has a static make method', function (): void {
        expect(Slug::make('_'))->toBeInstanceOf(Slug::class);
    });
});
