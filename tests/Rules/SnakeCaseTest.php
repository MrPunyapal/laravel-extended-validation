<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
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
        'USER_NAME',
        null,
    ]);

    it('passes for valid capital snake_case strings when capital option enabled', function (string $value): void {
        expect(Validator::make(['key' => $value], ['key' => new SnakeCase(capital: true)])->passes())->toBeTrue();
        expect(Validator::make(['key' => $value], ['key' => SnakeCase::capital()])->passes())->toBeTrue();
        expect(Validator::make(['key' => $value], ['key' => Rule::snakeCase(capital: true)])->passes())->toBeTrue();
        expect(Validator::make(['key' => $value], ['key' => 'snake_case:capital'])->passes())->toBeTrue();
    })->with([
        'USER_NAME',
        'FIRST_NAME_ID',
        'SLUG',
        'V1_API_ENDPOINT',
        'ITEM1_VALUE2',
    ]);

    it('fails for invalid strings when capital option enabled', function (mixed $value): void {
        expect(Validator::make(['key' => $value], ['key' => new SnakeCase(capital: true)])->fails())->toBeTrue();
        expect(Validator::make(['key' => $value], ['key' => SnakeCase::capital()])->fails())->toBeTrue();
        expect(Validator::make(['key' => $value], ['key' => 'snake_case:capital'])->fails())->toBeTrue();
    })->with([
        'user_name',
        'UserName',
        'userName',
        'USER-NAME',
        'USER NAME',
        '_LEADING_UNDERSCORE',
        'TRAILING_UNDERSCORE_',
        'DOUBLE__UNDERSCORE',
        null,
        123,
    ]);
});
