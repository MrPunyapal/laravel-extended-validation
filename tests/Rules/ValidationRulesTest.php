<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use MrPunyapal\LaravelExtendedValidation\Rules\Base64String;
use MrPunyapal\LaravelExtendedValidation\Rules\CountryCode;
use MrPunyapal\LaravelExtendedValidation\Rules\Domain;
use MrPunyapal\LaravelExtendedValidation\Rules\E164Phone;
use MrPunyapal\LaravelExtendedValidation\Rules\EvenNumber;
use MrPunyapal\LaravelExtendedValidation\Rules\HexColor;
use MrPunyapal\LaravelExtendedValidation\Rules\Isbn;
use MrPunyapal\LaravelExtendedValidation\Rules\Luhn;
use MrPunyapal\LaravelExtendedValidation\Rules\MaxWords;
use MrPunyapal\LaravelExtendedValidation\Rules\MinWords;
use MrPunyapal\LaravelExtendedValidation\Rules\NotEmail;
use MrPunyapal\LaravelExtendedValidation\Rules\OddNumber;
use MrPunyapal\LaravelExtendedValidation\Rules\Semver;
use MrPunyapal\LaravelExtendedValidation\Rules\Slug;
use MrPunyapal\LaravelExtendedValidation\Rules\WithoutAlias;

// ──────────────────────────────────────────────────────
// Slug
// ──────────────────────────────────────────────────────
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

// ──────────────────────────────────────────────────────
// EvenNumber
// ──────────────────────────────────────────────────────
describe('EvenNumber', function (): void {
    it('passes for even numbers', function (mixed $value): void {
        expect(Validator::make(['num' => $value], ['num' => new EvenNumber])->passes())->toBeTrue();
    })->with([0, 2, 4, -2, 100, '42']);

    it('fails for odd numbers', function (mixed $value): void {
        expect(Validator::make(['num' => $value], ['num' => new EvenNumber])->fails())->toBeTrue();
    })->with([1, 3, -1, 99, '7']);

    it('fails for non-numeric values', function (): void {
        expect(Validator::make(['num' => 'abc'], ['num' => new EvenNumber])->fails())->toBeTrue();
    });
});

// ──────────────────────────────────────────────────────
// OddNumber
// ──────────────────────────────────────────────────────
describe('OddNumber', function (): void {
    it('passes for odd numbers', function (mixed $value): void {
        expect(Validator::make(['num' => $value], ['num' => new OddNumber])->passes())->toBeTrue();
    })->with([1, 3, -1, 99, '7']);

    it('fails for even numbers', function (mixed $value): void {
        expect(Validator::make(['num' => $value], ['num' => new OddNumber])->fails())->toBeTrue();
    })->with([0, 2, 4, -2, 100, '42']);

    it('fails for non-numeric values', function (): void {
        expect(Validator::make(['num' => 'abc'], ['num' => new OddNumber])->fails())->toBeTrue();
    });
});

// ──────────────────────────────────────────────────────
// Semver
// ──────────────────────────────────────────────────────
describe('Semver', function (): void {
    it('passes for valid semver strings', function (string $value): void {
        expect(Validator::make(['v' => $value], ['v' => new Semver])->passes())->toBeTrue();
    })->with([
        '0.0.0',
        '1.0.0',
        '1.2.3',
        '10.20.30',
        '1.0.0-alpha',
        '1.0.0-alpha.1',
        '1.0.0-0.3.7',
        '1.0.0-x.7.z.92',
        '1.0.0+build.1',
        '1.0.0-beta+build.123',
    ]);

    it('fails for invalid semver strings', function (string $value): void {
        expect(Validator::make(['v' => $value], ['v' => new Semver])->fails())->toBeTrue();
    })->with([
        'v1.0.0',
        '1.0',
        '1',
        '1.0.0.0',
        '01.0.0',
        '1.02.0',
        '1.0.03',
    ]);
});

// ──────────────────────────────────────────────────────
// HexColor
// ──────────────────────────────────────────────────────
describe('HexColor', function (): void {
    it('passes for valid hex colors', function (string $value): void {
        expect(Validator::make(['color' => $value], ['color' => new HexColor])->passes())->toBeTrue();
    })->with([
        '#fff',
        '#FFF',
        '#ffffff',
        '#FFFFFF',
        '#ff00ff',
        '#ffff',
        '#ffffffff',
    ]);

    it('fails for invalid hex colors', function (string $value): void {
        expect(Validator::make(['color' => $value], ['color' => new HexColor])->fails())->toBeTrue();
    })->with([
        'fff',
        '#ff',
        '#fffff',
        '#gggggg',
        'red',
        '#fffffff',
    ]);
});

// ──────────────────────────────────────────────────────
// Base64String
// ──────────────────────────────────────────────────────
describe('Base64String', function (): void {
    it('passes for valid base64 strings', function (string $value): void {
        expect(Validator::make(['data' => $value], ['data' => new Base64String])->passes())->toBeTrue();
    })->with([
        'SGVsbG8gV29ybGQ=',       // "Hello World"
        'dGVzdA==',                 // "test"
        'YQ==',                     // "a"
    ]);

    it('fails for invalid base64 strings', function (mixed $value): void {
        expect(Validator::make(['data' => $value], ['data' => new Base64String])->fails())->toBeTrue();
    })->with([
        'not-valid-base64!!!',
        '',
        123,
    ]);

    it('validates data URI with mime types', function (): void {
        $rule = new Base64String('image/png', 'image/jpeg');
        $valid = 'data:image/png;base64,iVBORw0KGgo=';

        expect(Validator::make(['img' => $valid], ['img' => $rule])->passes())->toBeTrue();
    });
});

// ──────────────────────────────────────────────────────
// Luhn
// ──────────────────────────────────────────────────────
describe('Luhn', function (): void {
    it('passes for valid Luhn numbers', function (string $value): void {
        expect(Validator::make(['cc' => $value], ['cc' => new Luhn])->passes())->toBeTrue();
    })->with([
        '4111111111111111',   // Visa test
        '5500000000000004',   // Mastercard test
        '378282246310005',    // Amex test
        '79927398713',        // Known valid
    ]);

    it('fails for invalid Luhn numbers', function (string $value): void {
        expect(Validator::make(['cc' => $value], ['cc' => new Luhn])->fails())->toBeTrue();
    })->with([
        '1234567890123456',
        '0000000000000000',
        'abcdefg',
    ]);
});

// ──────────────────────────────────────────────────────
// MinWords
// ──────────────────────────────────────────────────────
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

// ──────────────────────────────────────────────────────
// MaxWords
// ──────────────────────────────────────────────────────
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

// ──────────────────────────────────────────────────────
// Domain
// ──────────────────────────────────────────────────────
describe('Domain', function (): void {
    it('passes for valid domains', function (string $value): void {
        expect(Validator::make(['d' => $value], ['d' => new Domain])->passes())->toBeTrue();
    })->with([
        'example.com',
        'sub.example.com',
        'deep.sub.example.co.uk',
        'my-site.org',
    ]);

    it('fails for invalid domains', function (string $value): void {
        expect(Validator::make(['d' => $value], ['d' => new Domain])->fails())->toBeTrue();
    })->with([
        'http://example.com',
        '-example.com',
        'example-.com',
        '192.168.1.1',
        'localhost',
        '.com',
    ]);
});

// ──────────────────────────────────────────────────────
// E164Phone
// ──────────────────────────────────────────────────────
describe('E164Phone', function (): void {
    it('passes for valid E.164 numbers', function (string $value): void {
        expect(Validator::make(['phone' => $value], ['phone' => new E164Phone])->passes())->toBeTrue();
    })->with([
        '+14155552671',
        '+442071234567',
        '+919876543210',
        '+12',
    ]);

    it('fails for invalid E.164 numbers', function (string $value): void {
        expect(Validator::make(['phone' => $value], ['phone' => new E164Phone])->fails())->toBeTrue();
    })->with([
        '14155552671',            // missing +
        '+0123456789',            // starts with 0
        '+1234567890123456',      // too long (16 digits)
        '+1',                     // too short
        'not-a-phone',
    ]);
});

// ──────────────────────────────────────────────────────
// Isbn
// ──────────────────────────────────────────────────────
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
});

// ──────────────────────────────────────────────────────
// CountryCode
// ──────────────────────────────────────────────────────
describe('CountryCode', function (): void {
    it('passes for valid alpha-2 codes', function (string $value): void {
        expect(Validator::make(['cc' => $value], ['cc' => new CountryCode])->passes())->toBeTrue();
    })->with(['US', 'GB', 'IN', 'DE', 'JP']);

    it('fails for invalid alpha-2 codes', function (string $value): void {
        expect(Validator::make(['cc' => $value], ['cc' => new CountryCode])->fails())->toBeTrue();
    })->with(['XX', 'ZZ', 'USA', '12']);

    it('is case insensitive', function (): void {
        expect(Validator::make(['cc' => 'us'], ['cc' => new CountryCode])->passes())->toBeTrue();
    });
});

// ──────────────────────────────────────────────────────
// WithoutAlias
// ──────────────────────────────────────────────────────
describe('WithoutAlias', function (): void {
    it('passes for emails without aliases', function (string $value): void {
        expect(Validator::make(['email' => $value], ['email' => new WithoutAlias])->passes())->toBeTrue();
    })->with([
        'user@example.com',
        'john.doe@gmail.com',
        'test@sub.domain.co.uk',
    ]);

    it('fails for emails with plus aliases', function (string $value): void {
        expect(Validator::make(['email' => $value], ['email' => new WithoutAlias])->fails())->toBeTrue();
    })->with([
        'user+alias@example.com',
        'john+test@gmail.com',
        '+user@example.com',
        'user+@example.com',
    ]);
});

// ──────────────────────────────────────────────────────
// NotEmail
// ──────────────────────────────────────────────────────
describe('NotEmail', function (): void {
    it('passes for non-email strings', function (string $value): void {
        expect(Validator::make(['username' => $value], ['username' => new NotEmail])->passes())->toBeTrue();
    })->with([
        'johndoe',
        'my-username',
        'hello world',
        'not-an-email',
    ]);

    it('fails for valid email addresses', function (string $value): void {
        expect(Validator::make(['username' => $value], ['username' => new NotEmail])->fails())->toBeTrue();
    })->with([
        'user@example.com',
        'test@gmail.com',
        'a@b.co',
    ]);
});

// ──────────────────────────────────────────────────────
// Rule Macros
// ──────────────────────────────────────────────────────
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
});
