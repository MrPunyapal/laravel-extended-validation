<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Validator;
use MrPunyapal\LaravelExtendedValidation\Rules\SnakeCase;

describe('SnakeCase', function (): void {
    it('passes for valid snake_case strings', function (string $value): void {
        expect(Validator::make(['key' => $value], ['key' => new SnakeCase])->passes())->toBeTrue();
    })->with([
        'user_name',
        'first_name_id',
        'slug',
        'v1_api_endpoint',
        'item1_value2',
    ]);

    it('fails for non snake_case strings', function (mixed $value): void {
        expect(Validator::make(['key' => $value], ['key' => new SnakeCase])->fails())->toBeTrue();
    })->with([
        'UserName',
        'userName',
        'user-name',
        'user name',
        '_leading_underscore',
        'trailing_underscore_',
        'double__underscore',
        null,
    ]);
});
