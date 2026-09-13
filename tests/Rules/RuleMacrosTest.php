<?php

declare(strict_types=1);

use Illuminate\Validation\Rule;
use MrPunyapal\LaravelExtendedValidation\Rules\AlphaNumAscii;
use MrPunyapal\LaravelExtendedValidation\Rules\AlphaUnderscore;
use MrPunyapal\LaravelExtendedValidation\Rules\Base64String;
use MrPunyapal\LaravelExtendedValidation\Rules\Cidr;
use MrPunyapal\LaravelExtendedValidation\Rules\CountryCode;
use MrPunyapal\LaravelExtendedValidation\Rules\Domain;
use MrPunyapal\LaravelExtendedValidation\Rules\E164Phone;
use MrPunyapal\LaravelExtendedValidation\Rules\EmailDomain;
use MrPunyapal\LaravelExtendedValidation\Rules\EvenNumber;
use MrPunyapal\LaravelExtendedValidation\Rules\HexColor;
use MrPunyapal\LaravelExtendedValidation\Rules\Isbn;
use MrPunyapal\LaravelExtendedValidation\Rules\Latitude;
use MrPunyapal\LaravelExtendedValidation\Rules\Longitude;
use MrPunyapal\LaravelExtendedValidation\Rules\Luhn;
use MrPunyapal\LaravelExtendedValidation\Rules\MaxWords;
use MrPunyapal\LaravelExtendedValidation\Rules\MinWords;
use MrPunyapal\LaravelExtendedValidation\Rules\MultipleOf;
use MrPunyapal\LaravelExtendedValidation\Rules\NoHtml;
use MrPunyapal\LaravelExtendedValidation\Rules\NotEmail;
use MrPunyapal\LaravelExtendedValidation\Rules\NotHashed;
use MrPunyapal\LaravelExtendedValidation\Rules\OddNumber;
use MrPunyapal\LaravelExtendedValidation\Rules\Semver;
use MrPunyapal\LaravelExtendedValidation\Rules\Slug;
use MrPunyapal\LaravelExtendedValidation\Rules\SnakeCase;
use MrPunyapal\LaravelExtendedValidation\Rules\UnlessBetween;
use MrPunyapal\LaravelExtendedValidation\Rules\UrlProtocol;
use MrPunyapal\LaravelExtendedValidation\Rules\WithoutAlias;
use MrPunyapal\LaravelExtendedValidation\Rules\WithoutWhitespace;

describe('Rule macros', function (): void {
    it('registers Rule::slug()', function (): void {
        expect(Rule::slug())->toBeInstanceOf(Slug::class);
    });

    it('registers Rule::even()', function (): void {
        expect(Rule::even())->toBeInstanceOf(EvenNumber::class);
    });

    it('registers Rule::odd()', function (): void {
        expect(Rule::odd())->toBeInstanceOf(OddNumber::class);
    });

    it('registers Rule::semver()', function (): void {
        expect(Rule::semver())->toBeInstanceOf(Semver::class);
    });

    it('registers Rule::base64String()', function (): void {
        expect(Rule::base64String())->toBeInstanceOf(Base64String::class);
    });

    it('registers Rule::luhn()', function (): void {
        expect(Rule::luhn())->toBeInstanceOf(Luhn::class);
    });

    it('registers Rule::minWords()', function (): void {
        expect(Rule::minWords(5))->toBeInstanceOf(MinWords::class);
    });

    it('registers Rule::maxWords()', function (): void {
        expect(Rule::maxWords(5))->toBeInstanceOf(MaxWords::class);
    });

    it('registers Rule::domain()', function (): void {
        expect(Rule::domain())->toBeInstanceOf(Domain::class);
    });

    it('registers Rule::e164()', function (): void {
        expect(Rule::e164())->toBeInstanceOf(E164Phone::class);
    });

    it('registers Rule::isbn()', function (): void {
        expect(Rule::isbn())->toBeInstanceOf(Isbn::class);
    });

    it('registers Rule::countryCode()', function (): void {
        expect(Rule::countryCode())->toBeInstanceOf(CountryCode::class);
    });

    it('registers Rule::hexColor()', function (): void {
        expect(Rule::hexColor())->toBeInstanceOf(HexColor::class);
    });

    it('registers Rule::withoutAlias()', function (): void {
        expect(Rule::withoutAlias())->toBeInstanceOf(WithoutAlias::class);
    });

    it('registers Rule::notEmail()', function (): void {
        expect(Rule::notEmail())->toBeInstanceOf(NotEmail::class);
    });

    it('registers Rule::latitude()', function (): void {
        expect(Rule::latitude())->toBeInstanceOf(Latitude::class);
    });

    it('registers Rule::longitude()', function (): void {
        expect(Rule::longitude())->toBeInstanceOf(Longitude::class);
    });

    it('registers Rule::cidr()', function (): void {
        expect(Rule::cidr())->toBeInstanceOf(Cidr::class);
    });

    it('registers Rule::emailDomain()', function (): void {
        expect(Rule::emailDomain())->toBeInstanceOf(EmailDomain::class);
    });

    it('registers Rule::notHashed()', function (): void {
        expect(Rule::notHashed())->toBeInstanceOf(NotHashed::class);
    });

    it('registers Rule::alphaUnderscore()', function (): void {
        expect(Rule::alphaUnderscore())->toBeInstanceOf(AlphaUnderscore::class);
    });

    it('registers Rule::unlessBetween()', function (): void {
        expect(Rule::unlessBetween(1, 10))->toBeInstanceOf(UnlessBetween::class);
    });

    it('registers Rule::withoutWhitespace()', function (): void {
        expect(Rule::withoutWhitespace())->toBeInstanceOf(WithoutWhitespace::class);
    });

    it('registers Rule::noHtml()', function (): void {
        expect(Rule::noHtml())->toBeInstanceOf(NoHtml::class);
    });

    it('registers Rule::urlProtocol()', function (): void {
        expect(Rule::urlProtocol('https'))->toBeInstanceOf(UrlProtocol::class);
    });

    it('registers Rule::snakeCase()', function (): void {
        expect(Rule::snakeCase())->toBeInstanceOf(SnakeCase::class);
    });

    it('registers Rule::multipleOf()', function (): void {
        expect(Rule::multipleOf(5))->toBeInstanceOf(MultipleOf::class);
    });

    it('registers Rule::alphaNumAscii()', function (): void {
        expect(Rule::alphaNumAscii())->toBeInstanceOf(AlphaNumAscii::class);
    });
});
