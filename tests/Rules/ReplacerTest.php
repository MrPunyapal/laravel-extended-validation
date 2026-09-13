<?php

declare(strict_types=1);

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;

describe('Validation Replacer and Translations', function (): void {
    afterEach(function (): void {
        App::setLocale('en');
    });

    it('replaces :min placeholder for min_words in English and Spanish', function (): void {
        $validatorEn = Validator::make(['bio' => 'too short'], ['bio' => 'min_words:5']);
        expect($validatorEn->fails())->toBeTrue();
        expect($validatorEn->errors()->first('bio'))->toBe('The bio must have at least 5 words.');

        App::setLocale('es');
        $validatorEs = Validator::make(['bio' => 'too short'], ['bio' => 'min_words:5']);
        expect($validatorEs->fails())->toBeTrue();
        expect($validatorEs->errors()->first('bio'))->toBe('El campo bio debe tener al menos 5 palabras.');
    });

    it('replaces :max placeholder for max_words in English and Spanish', function (): void {
        $validatorEn = Validator::make(['bio' => 'one two three four five six'], ['bio' => 'max_words:5']);
        expect($validatorEn->fails())->toBeTrue();
        expect($validatorEn->errors()->first('bio'))->toBe('The bio must not exceed 5 words.');

        App::setLocale('es');
        $validatorEs = Validator::make(['bio' => 'one two three four five six'], ['bio' => 'max_words:5']);
        expect($validatorEs->fails())->toBeTrue();
        expect($validatorEs->errors()->first('bio'))->toBe('El campo bio no debe superar 5 palabras.');
    });

    it('replaces :step placeholder for multiple_of in English and Spanish', function (): void {
        $validatorEn = Validator::make(['count' => 7], ['count' => 'multiple_of:5']);
        expect($validatorEn->fails())->toBeTrue();
        expect($validatorEn->errors()->first('count'))->toBe('The count must be a multiple of 5.');

        App::setLocale('es');
        $validatorEs = Validator::make(['count' => 7], ['count' => 'multiple_of:5']);
        expect($validatorEs->fails())->toBeTrue();
        expect($validatorEs->errors()->first('count'))->toBe('El campo count debe ser un múltiplo de 5.');
    });

    it('replaces :min and :max placeholders for unless_between in English and Spanish', function (): void {
        $validatorEn = Validator::make(['val' => 15], ['val' => 'unless_between:10,20']);
        expect($validatorEn->fails())->toBeTrue();
        expect($validatorEn->errors()->first('val'))->toBe('The val must not be between 10 and 20.');

        App::setLocale('es');
        $validatorEs = Validator::make(['val' => 15], ['val' => 'unless_between:10,20']);
        expect($validatorEs->fails())->toBeTrue();
        expect($validatorEs->errors()->first('val'))->toBe('El campo val no debe estar entre 10 y 20.');
    });

    it('replaces :protocols placeholder for url_protocol in English and Spanish', function (): void {
        $validatorEn = Validator::make(['link' => 'ftp://example.com'], ['link' => 'url_protocol:http,https']);
        expect($validatorEn->fails())->toBeTrue();
        expect($validatorEn->errors()->first('link'))->toBe('The link must use one of the following protocols: http, https.');

        App::setLocale('es');
        $validatorEs = Validator::make(['link' => 'ftp://example.com'], ['link' => 'url_protocol:http,https']);
        expect($validatorEs->fails())->toBeTrue();
        expect($validatorEs->errors()->first('link'))->toBe('El campo link debe usar uno de los siguientes protocolos: http, https.');
    });

    it('replaces placeholders in custom validation messages', function (): void {
        $validator = Validator::make(
            ['bio' => 'short'],
            ['bio' => 'min_words:5'],
            ['bio.min_words' => 'Field :attribute needs at least :min words.']
        );

        expect($validator->fails())->toBeTrue();
        expect($validator->errors()->first('bio'))->toBe('Field bio needs at least 5 words.');
    });

    it('replaces :attribute for non-parameterized rules in English and Spanish', function (): void {
        $validatorEn = Validator::make(['number' => 3], ['number' => 'even']);
        expect($validatorEn->fails())->toBeTrue();
        expect($validatorEn->errors()->first('number'))->toBe('The number must be an even number.');

        App::setLocale('es');
        $validatorEs = Validator::make(['number' => 3], ['number' => 'even']);
        expect($validatorEs->fails())->toBeTrue();
        expect($validatorEs->errors()->first('number'))->toBe('El campo number debe ser un número par.');
    });

    it('replaces :attribute for hex_color in English and Spanish', function (): void {
        $validatorEn = Validator::make(['color' => 'invalid'], ['color' => 'hex_color']);
        expect($validatorEn->fails())->toBeTrue();
        expect($validatorEn->errors()->first('color'))->toBe('The color must be a valid hex color code.');

        App::setLocale('es');
        $validatorEs = Validator::make(['color' => 'invalid'], ['color' => 'hex_color']);
        expect($validatorEs->fails())->toBeTrue();
        expect($validatorEs->errors()->first('color'))->toBe('El campo color debe ser un código de color hexadecimal válido.');
    });

    it('replaces custom messages for unless_between with :min and :max', function (): void {
        $validator = Validator::make(
            ['val' => 15],
            ['val' => 'unless_between:10,20'],
            ['val.unless_between' => ':Attribute out of bounds! Range is :min to :max.']
        );

        expect($validator->fails())->toBeTrue();
        expect($validator->errors()->first('val'))->toBe('Val out of bounds! Range is 10 to 20.');
    });
});
