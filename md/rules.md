---
title: Rules Reference
description: Complete reference and usage examples for all 15 validation rules in mrpunyapal/laravel-extended-validation.
---

# Rules Reference

Complete reference for all 15 validation rules included in the package.

---

## without_alias

Validates that an email address does not contain a plus-addressed sub-alias (e.g. `user+tag@gmail.com`). Useful for preventing trial abuse and duplicate account creation.

- **Class**: `MrPunyapal\LaravelExtendedValidation\Rules\WithoutAlias`
- **Macro**: `Rule::withoutAlias()`
- **String**: `without_alias`

### Usage

```php
use MrPunyapal\LaravelExtendedValidation\Rules\WithoutAlias;
use Illuminate\Validation\Rule;

// Class syntax
'email' => ['required', 'email', new WithoutAlias]

// Macro syntax
'email' => ['required', 'email', Rule::withoutAlias()]

// String syntax
'email' => 'required|email|without_alias'
```

### Examples

| Input | Result |
| --- | --- |
| `user@example.com` | Passes |
| `john.doe@gmail.com` | Passes |
| `user+tag@gmail.com` | Fails |
| `john+promo@domain.com` | Fails |
| `+user@domain.com` | Fails |

---

## not_email

Validates that a given string is not a valid email address. Useful for username fields to prevent collisions in applications that allow login with "Email or Username".

- **Class**: `MrPunyapal\LaravelExtendedValidation\Rules\NotEmail`
- **Macro**: `Rule::notEmail()`
- **String**: `not_email`

### Usage

```php
use MrPunyapal\LaravelExtendedValidation\Rules\NotEmail;
use Illuminate\Validation\Rule;

'username' => ['required', 'string', 'min:3', 'max:30', new NotEmail]
'username' => ['required', 'string', Rule::notEmail()]
'username' => 'required|string|not_email'
```

### Examples

| Input | Result |
| --- | --- |
| `johndoe` | Passes |
| `cool_user42` | Passes |
| `john@example.com` | Fails |
| `admin@domain.io` | Fails |

---

## slug

Validates that a string is a clean, URL-friendly slug. Rejects uppercase characters, whitespace, special characters, and consecutive or trailing separators.

- **Class**: `MrPunyapal\LaravelExtendedValidation\Rules\Slug`
- **Macro**: `Rule::slug(string $separator = '-')`
- **String**: `slug` or `slug:{separator}`

### Usage

```php
use MrPunyapal\LaravelExtendedValidation\Rules\Slug;
use Illuminate\Validation\Rule;

// Default dash separator
'slug' => ['required', new Slug]
'slug' => ['required', Rule::slug()]
'slug' => 'required|slug'

// Custom underscore separator
'slug' => ['required', new Slug('_')]
'slug' => ['required', Rule::slug('_')]
'slug' => 'required|slug:_'
```

### Examples (with default `-`)

| Input | Result |
| --- | --- |
| `my-awesome-post` | Passes |
| `post-123` | Passes |
| `My-Awesome-Post` | Fails (uppercase) |
| `my awesome post` | Fails (spaces) |
| `my--post` | Fails (consecutive separators) |
| `-my-post` | Fails (leading separator) |

---

## even

Validates that a numeric input represents an even integer.

- **Class**: `MrPunyapal\LaravelExtendedValidation\Rules\EvenNumber`
- **Macro**: `Rule::even()`
- **String**: `even`

### Usage

```php
use MrPunyapal\LaravelExtendedValidation\Rules\EvenNumber;
use Illuminate\Validation\Rule;

'team_size' => ['required', 'integer', new EvenNumber]
'team_size' => ['required', 'integer', Rule::even()]
'team_size' => 'required|integer|even'
```

### Examples

| Input | Result |
| --- | --- |
| `0`, `2`, `4`, `100`, `'42'` | Passes |
| `1`, `3`, `-1`, `'7'`, `'abc'` | Fails |

---

## odd

Validates that a numeric input represents an odd integer.

- **Class**: `MrPunyapal\LaravelExtendedValidation\Rules\OddNumber`
- **Macro**: `Rule::odd()`
- **String**: `odd`

### Usage

```php
use MrPunyapal\LaravelExtendedValidation\Rules\OddNumber;
use Illuminate\Validation\Rule;

'step' => ['required', 'integer', new OddNumber]
'step' => ['required', 'integer', Rule::odd()]
'step' => 'required|integer|odd'
```

### Examples

| Input | Result |
| --- | --- |
| `1`, `3`, `-1`, `99`, `'7'` | Passes |
| `0`, `2`, `4`, `100`, `'42'`, `'abc'` | Fails |

---

## semver

Validates strings against the official [Semantic Versioning 2.0.0](https://semver.org) specification, including optional pre-release tags and build metadata.

- **Class**: `MrPunyapal\LaravelExtendedValidation\Rules\Semver`
- **Macro**: `Rule::semver()`
- **String**: `semver`

### Usage

```php
use MrPunyapal\LaravelExtendedValidation\Rules\Semver;
use Illuminate\Validation\Rule;

'version' => ['required', new Semver]
'version' => ['required', Rule::semver()]
'version' => 'required|semver'
```

### Examples

| Input | Result |
| --- | --- |
| `1.0.0`, `0.1.0` | Passes |
| `1.2.3-alpha.1` | Passes |
| `2.0.0-beta+build.123` | Passes |
| `v1.0.0` | Fails (prefix not allowed in SemVer 2.0) |
| `1.0` | Fails (missing patch component) |

---

## base64_string

Validates that an attribute is valid base64-encoded data, with optional MIME type filtering for Data URIs.

- **Class**: `MrPunyapal\LaravelExtendedValidation\Rules\Base64String`
- **Macro**: `Rule::base64String(array|string $allowedMimeTypes = [])`
- **String**: `base64_string` or `base64_string:{mimes}`

### Usage

```php
use MrPunyapal\LaravelExtendedValidation\Rules\Base64String;
use Illuminate\Validation\Rule;

// Standard base64 payload
'payload' => ['required', new Base64String]

// Data URI restricted to specific image types
'avatar' => ['required', new Base64String(['image/png', 'image/jpeg'])]
'avatar' => ['required', Rule::base64String('image/png', 'image/jpeg')]
'avatar' => 'required|base64_string:image/png,image/jpeg'
```

---

## luhn

Validates numeric strings against the Luhn/MOD-10 algorithm. Common for credit cards, debit cards, IMEI numbers, and national identifiers.

- **Class**: `MrPunyapal\LaravelExtendedValidation\Rules\Luhn`
- **Macro**: `Rule::luhn()`
- **String**: `luhn`

### Usage

```php
use MrPunyapal\LaravelExtendedValidation\Rules\Luhn;
use Illuminate\Validation\Rule;

'card_number' => ['required', new Luhn]
'card_number' => ['required', Rule::luhn()]
'card_number' => 'required|luhn'
```

---

## min_words

Validates that a string contains at least a specified number of words.

- **Class**: `MrPunyapal\LaravelExtendedValidation\Rules\MinWords`
- **Macro**: `Rule::minWords(int $min)`
- **String**: `min_words:{min}`

### Usage

```php
use MrPunyapal\LaravelExtendedValidation\Rules\MinWords;
use Illuminate\Validation\Rule;

'bio' => ['required', 'string', new MinWords(10)]
'bio' => ['required', 'string', Rule::minWords(10)]
'bio' => 'required|string|min_words:10'
```

---

## max_words

Validates that a string does not exceed a specified number of words.

- **Class**: `MrPunyapal\LaravelExtendedValidation\Rules\MaxWords`
- **Macro**: `Rule::maxWords(int $max)`
- **String**: `max_words:{max}`

### Usage

```php
use MrPunyapal\LaravelExtendedValidation\Rules\MaxWords;
use Illuminate\Validation\Rule;

'summary' => ['required', 'string', new MaxWords(50)]
'summary' => ['required', 'string', Rule::maxWords(50)]
'summary' => 'required|string|max_words:50'
```

---

## domain

Validates that a string is a valid domain name (FQDN) without requiring `http://` or `https://` protocol schemes.

- **Class**: `MrPunyapal\LaravelExtendedValidation\Rules\Domain`
- **Macro**: `Rule::domain()`
- **String**: `domain`

### Usage

```php
use MrPunyapal\LaravelExtendedValidation\Rules\Domain;
use Illuminate\Validation\Rule;

'website' => ['required', new Domain]
'website' => ['required', Rule::domain()]
'website' => 'required|domain'
```

### Examples

| Input | Result |
| --- | --- |
| `example.com` | Passes |
| `sub.example.co.uk` | Passes |
| `https://example.com` | Fails (protocol not expected) |
| `192.168.1.1` | Fails (IP address rejected) |
| `localhost` | Fails (requires valid TLD) |

---

## e164

Validates international telephone numbers according to the ITU-T E.164 format (`+` followed by 2 to 15 digits).

- **Class**: `MrPunyapal\LaravelExtendedValidation\Rules\E164Phone`
- **Macro**: `Rule::e164()`
- **String**: `e164`

### Usage

```php
use MrPunyapal\LaravelExtendedValidation\Rules\E164Phone;
use Illuminate\Validation\Rule;

'phone' => ['required', new E164Phone]
'phone' => ['required', Rule::e164()]
'phone' => 'required|e164'
```

### Examples

| Input | Result |
| --- | --- |
| `+14155552671` | Passes |
| `+442071234567` | Passes |
| `+919876543210` | Passes |
| `14155552671` | Fails (missing `+`) |
| `+0123456789` | Fails (cannot start with 0) |

---

## isbn

Validates International Standard Book Numbers (ISBN-10, ISBN-13, or both) with mathematical checksum verification.

- **Class**: `MrPunyapal\LaravelExtendedValidation\Rules\Isbn`
- **Macro**: `Rule::isbn(?string $type = null)`
- **String**: `isbn`, `isbn:10`, `isbn:13`

### Usage

```php
use MrPunyapal\LaravelExtendedValidation\Rules\Isbn;
use Illuminate\Validation\Rule;

// Accepts either ISBN-10 or ISBN-13
'book' => ['required', new Isbn]
'book' => ['required', Rule::isbn()]
'book' => 'required|isbn'

// ISBN-10 only
'book' => ['required', new Isbn('10')]
'book' => ['required', Rule::isbn('10')]
'book' => 'required|isbn:10'

// ISBN-13 only
'book' => ['required', new Isbn('13')]
'book' => ['required', Rule::isbn('13')]
'book' => 'required|isbn:13'
```

---

## country_code

Validates ISO 3166-1 country codes (alpha-2 or alpha-3 format).

- **Class**: `MrPunyapal\LaravelExtendedValidation\Rules\CountryCode`
- **Macro**: `Rule::countryCode(string $format = 'alpha2')`
- **String**: `country_code` or `country_code:{format}`

### Usage

```php
use MrPunyapal\LaravelExtendedValidation\Rules\CountryCode;
use Illuminate\Validation\Rule;

// ISO 3166-1 alpha-2 (US, GB, IN, DE, JP, etc.)
'country' => ['required', new CountryCode]
'country' => ['required', Rule::countryCode()]
'country' => 'required|country_code'

// ISO 3166-1 alpha-3 (USA, GBR, IND, DEU, JPN, etc.)
'country' => ['required', new CountryCode('alpha3')]
'country' => ['required', Rule::countryCode('alpha3')]
'country' => 'required|country_code:alpha3'
```

---

## hex_color

Validates CSS hex color codes (supporting 3, 4, 6, or 8 hexadecimal characters preceded by `#`).

- **Class**: `MrPunyapal\LaravelExtendedValidation\Rules\HexColor`
- **Macro**: `Rule::hexColor()`
- **String**: `hex_color`

### Usage

```php
use MrPunyapal\LaravelExtendedValidation\Rules\HexColor;
use Illuminate\Validation\Rule;

'accent' => ['required', new HexColor]
'accent' => ['required', Rule::hexColor()]
'accent' => 'required|hex_color'
```

### Examples

| Input | Result |
| --- | --- |
| `#fff`, `#FFF` | Passes (3-digit) |
| `#ffff` | Passes (4-digit with alpha) |
| `#ffffff` | Passes (6-digit) |
| `#ffffffff` | Passes (8-digit with alpha) |
| `fff` | Fails (missing `#`) |
| `#gggggg` | Fails (invalid hex characters) |
