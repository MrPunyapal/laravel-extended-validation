<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Validator;
use MrPunyapal\LaravelExtendedValidation\Rules\UrlProtocol;

describe('UrlProtocol', function (): void {
    it('passes when url scheme matches allowed protocols', function (): void {
        $rule = UrlProtocol::make('https', 'http');

        expect(Validator::make(['url' => 'https://laravel.com'], ['url' => $rule])->passes())->toBeTrue();
        expect(Validator::make(['url' => 'http://example.com'], ['url' => $rule])->passes())->toBeTrue();
        expect(Validator::make(['url' => 'ftp://files.example.com'], ['url' => $rule])->fails())->toBeTrue();
    });

    it('supports array of protocols', function (): void {
        $rule = new UrlProtocol(['sftp', 'ssh']);

        expect(Validator::make(['url' => 'sftp://server.io'], ['url' => $rule])->passes())->toBeTrue();
        expect(Validator::make(['url' => 'ssh://server.io'], ['url' => $rule])->passes())->toBeTrue();
        expect(Validator::make(['url' => 'https://server.io'], ['url' => $rule])->fails())->toBeTrue();
    });

    it('fails for non-strings and invalid URLs', function (mixed $value): void {
        $rule = UrlProtocol::make('https');
        expect(Validator::make(['url' => $value], ['url' => $rule])->fails())->toBeTrue();
    })->with([
        'not-a-url',
        123,
        null,
    ]);
});
