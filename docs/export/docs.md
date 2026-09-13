# Acknowledgements

> Community contributors and rejected Laravel pull requests that inspired rules in this package.

# Acknowledgements

This page credits the Laravel community contributors and rejected pull requests that inspired the rules in this package.

## Overview

The Laravel core team maintains strict criteria for what enters the framework core. To keep the framework focused and adhere strictly to official RFC standards, many specialized validation rules are closed or rejected.

Those pull requests reflect real problems developers encounter in production applications. This package brings those community ideas together in one place with zero extra dependencies, modern PHP 8.3+ typing, and full test coverage.

## Inspired pull requests

The table below lists each rule, the pull request that proposed it, and the original use case.

| Rule | Pull request | Inspiration |
| --- | --- | --- |
| [`without_alias`](rules.md#without_alias) | [#61522](https://github.com/laravel/framework/pull/61522) | Reject plus-addressed email aliases (`user+tag@gmail.com`) to prevent trial abuse. Proposed by Punyapal; inspired the creation of this package. |
| [`not_email`](rules.md#not_email) | [#32103](https://github.com/laravel/framework/pull/32103) | Prevent usernames and account handles from matching email formats to avoid login ambiguity. |
| [`slug`](rules.md#slug) | [#27521](https://github.com/laravel/framework/pull/27521), [#36284](https://github.com/laravel/framework/pull/36284) | Validate clean, URL-safe slugs with customizable separators. |
| [`even`](rules.md#even), [`odd`](rules.md#odd) | [#33719](https://github.com/laravel/framework/pull/33719) | Validate even and odd integer inputs without custom closures. |
| [`semver`](rules.md#semver) | [#27798](https://github.com/laravel/framework/pull/27798), [#31086](https://github.com/laravel/framework/pull/31086) | Validate Semantic Versioning 2.0.0 strings, including pre-release tags and build metadata. |
| [`base64_string`](rules.md#base64_string) | [#31065](https://github.com/laravel/framework/pull/31065), [#36323](https://github.com/laravel/framework/pull/36323) | Validate Base64 strings and Data URIs with optional MIME-type filters. |
| [`luhn`](rules.md#luhn) | [#28372](https://github.com/laravel/framework/pull/28372), [#38706](https://github.com/laravel/framework/pull/38706) | Validate Luhn (MOD-10) checksum digits for payment cards, IMEIs, and identification numbers. |
| [`min_words`](rules.md#min_words), [`max_words`](rules.md#max_words) | [#37852](https://github.com/laravel/framework/pull/37852), [#41323](https://github.com/laravel/framework/pull/41323) | Validate word count boundaries for text fields, summaries, and bios. |
| [`domain`](rules.md#domain) | [#32197](https://github.com/laravel/framework/pull/32197) | Validate domain names without requiring HTTP or HTTPS protocol prefixes. |
| [`e164`](rules.md#e164) | [#36720](https://github.com/laravel/framework/pull/36720) | Validate international phone numbers formatted per ITU-T E.164. |
| [`isbn`](rules.md#isbn) | [#29402](https://github.com/laravel/framework/pull/29402) | Validate ISBN-10 and ISBN-13 book identifiers with check-digit verification. |
| [`country_code`](rules.md#country_code) | [#35860](https://github.com/laravel/framework/pull/35860) | Validate ISO 3166-1 alpha-2 and alpha-3 country codes. |
| [`hex_color`](rules.md#hex_color) | [#38202](https://github.com/laravel/framework/pull/38202) | Validate CSS hex color codes (3, 4, 6, or 8 digits). |
| [`latitude`](rules.md#latitude), [`longitude`](rules.md#longitude) | [#32039](https://github.com/laravel/framework/pull/32039) | Validate coordinate ranges for latitude (`[-90, 90]`) and longitude (`[-180, 180]`). |
| [`cidr`](rules.md#cidr) | [#35874](https://github.com/laravel/framework/pull/35874) | Validate IPv4 and IPv6 Classless Inter-Domain Routing (CIDR) subnet notations. |
| [`email_domain`](rules.md#email_domain) | [#31885](https://github.com/laravel/framework/pull/31885) | Restrict email addresses by domain whitelist or disposable domain blacklist. |
| [`not_hashed`](rules.md#not_hashed) | [#39891](https://github.com/laravel/framework/pull/39891) | Verify that a password input is plain text and has not already been hashed with bcrypt or Argon2. |
| [`alpha_underscore`](rules.md#alpha_underscore) | [#28643](https://github.com/laravel/framework/pull/28643) | Validate alphanumeric strings with underscores for strict code and database identifiers. |
| [`unless_between`](rules.md#unless_between) | [#34512](https://github.com/laravel/framework/pull/34512) | Validate that numeric values fall outside a given range. |
| [`without_whitespace`](rules.md#without_whitespace) | [#15190](https://github.com/laravel/framework/pull/15190) | Ensure input contains no whitespace characters for tokens and identifiers. |
| [`no_html`](rules.md#no_html) | [#42626](https://github.com/laravel/framework/pull/42626) | Ensure input contains no HTML or XML tags in plain text fields. |
| [`url_protocol`](rules.md#url_protocol) | [#44909](https://github.com/laravel/framework/pull/44909), [#44911](https://github.com/laravel/framework/pull/44911) | Validate that a URL uses an approved protocol scheme. |
| [`snake_case`](rules.md#snake_case) | [#45348](https://github.com/laravel/framework/pull/45348) | Validate strict snake_case formatting for slugs, column names, and keys. |
| [`multiple_of`](rules.md#multiple_of) | [#28135](https://github.com/laravel/framework/pull/28135), [#34959](https://github.com/laravel/framework/pull/34959) | Validate that numeric values are an exact multiple of a given step. |
| [`alpha_num_ascii`](rules.md#alpha_num_ascii) | [#45609](https://github.com/laravel/framework/pull/45609) | Enforce strict ASCII-only alphanumeric characters, rejecting Unicode homoglyphs. |

## Submitting a rule

If you know of another rejected validation rule from `laravel/framework` that fits this package:

1. Check that the rule can be implemented without adding third-party dependencies.
2. Open an issue or pull request on [GitHub](https://github.com/mrpunyapal/laravel-extended-validation).
3. Include a link to the original `laravel/framework` pull request or discussion.



---

# Configuration

> Configure and selectively enable or disable validation rules in mrpunyapal/laravel-extended-validation.

# Configuration

You can selectively enable or disable individual validation rules to suit your application and avoid naming collisions with other packages.

## Publish the config file

Run the Artisan publish command:

```bash
php artisan vendor:publish --tag="laravel-extended-validation-config"
```

## Configuration options

The published file lives at `config/extended-validation.php`:

```php
return [

    /*
    |--------------------------------------------------------------------------
    | Enabled Rules
    |--------------------------------------------------------------------------
    |
    | You may disable specific validation rules by setting them to false.
    | All rules are enabled by default.
    |
    */

    'rules' => [
        'slug' => true,
        'even' => true,
        'odd' => true,
        'semver' => true,
        'base64_string' => true,
        'luhn' => true,
        'min_words' => true,
        'max_words' => true,
        'domain' => true,
        'e164' => true,
        'isbn' => true,
        'country_code' => true,
        'hex_color' => true,
        'without_alias' => true,
        'not_email' => true,
    ],

];
```

To disable any rule, set its value to `false`. Disabled rules are not registered on `Validator` or as macros on `Rule`.

## Next steps

- Read [Usage](usage.md) to see how to apply rules in form requests and controllers.
- Check the [Rules reference](rules.md) for individual rule behavior.


---

# Installation

> Install and configure mrpunyapal/laravel-extended-validation in your Laravel application.

# Installation

## Requirements

- PHP `^8.3`, `^8.4`, or `^8.5`
- Laravel 11, 12, or 13

## Install via Composer

Require the package as a dependency:

```bash
composer require mrpunyapal/laravel-extended-validation
```

## Package auto-discovery

Laravel automatically registers `MrPunyapal\LaravelExtendedValidation\LaravelExtendedValidationServiceProvider` through package auto-discovery. You do not need to register the provider manually.

## Publishing configuration

Publish the configuration file to enable or disable specific rules:

```bash
php artisan vendor:publish --tag="laravel-extended-validation-config"
```

This creates `config/extended-validation.php`. See [Configuration](configuration.md) for available settings.

## Publishing translations

Publish the language files to customize error messages:

```bash
php artisan vendor:publish --tag="laravel-extended-validation-translations"
```

This publishes translation lines to `lang/vendor/laravel-extended-validation/en/validation.php`.

## Laravel Boost

This package includes a Laravel Boost skill named `laravel-extended-validation-development` for AI-assisted development.

If your application uses Laravel Boost, discover the skill with:

```bash
php artisan boost:update --discover
```

## Next steps

- Read [Configuration](configuration.md) to manage rule toggles.
- Explore [Usage](usage.md) for the three syntax options.
- Browse the [Rules reference](rules.md) for full examples.


---

# Laravel Extended Validation

> A collection of 28 useful validation rules for Laravel applications, available as rule classes, fluent Rule macros, and string rules.

# Laravel Extended Validation

A collection of 28 validation rules for Laravel applications. Every rule works in three ways: as an invokable rule class, as a fluent `Rule::` macro, and as a classic string rule.

```bash
composer require mrpunyapal/laravel-extended-validation
```

## Quick start

Use any rule with class syntax, fluent macros, or pipe-delimited strings:

```php
use Illuminate\Validation\Rule;
use MrPunyapal\LaravelExtendedValidation\Rules\WithoutAlias;
use MrPunyapal\LaravelExtendedValidation\Rules\NotEmail;
use MrPunyapal\LaravelExtendedValidation\Rules\Slug;

$request->validate([
    'email'    => ['required', 'email', new WithoutAlias],
    'username' => ['required', 'string', Rule::notEmail()],
    'slug'     => 'required|slug',
]);
```

## Available rules

| Rule | Class | Description | Syntax |
| --- | --- | --- | --- |
| [without_alias](rules.md#without_alias) | `WithoutAlias` | Reject plus-addressed email aliases (e.g. `user+tag@gmail.com`) | `without_alias` |
| [not_email](rules.md#not_email) | `NotEmail` | Ensure a value is not an email address | `not_email` |
| [slug](rules.md#slug) | `Slug` | Validate clean URL slugs with configurable separator | `slug` / `slug:_` |
| [even](rules.md#even) | `EvenNumber` | Ensure numeric input is an even integer | `even` |
| [odd](rules.md#odd) | `OddNumber` | Ensure numeric input is an odd integer | `odd` |
| [semver](rules.md#semver) | `Semver` | Validate Semantic Versioning 2.0.0 strings | `semver` |
| [base64_string](rules.md#base64_string) | `Base64String` | Validate base64 strings and data URIs with optional MIME filters | `base64_string` |
| [luhn](rules.md#luhn) | `Luhn` | Validate numeric strings against the Luhn/MOD-10 checksum | `luhn` |
| [min_words](rules.md#min_words) | `MinWords` | Validate minimum word count | `min_words:N` |
| [max_words](rules.md#max_words) | `MaxWords` | Validate maximum word count | `max_words:N` |
| [domain](rules.md#domain) | `Domain` | Validate domain names without requiring protocols | `domain` |
| [e164](rules.md#e164) | `E164Phone` | Validate international phone numbers in E.164 format | `e164` |
| [isbn](rules.md#isbn) | `Isbn` | Validate ISBN-10, ISBN-13, or both with checksums | `isbn` / `isbn:10` / `isbn:13` |
| [country_code](rules.md#country_code) | `CountryCode` | Validate ISO 3166-1 country codes (alpha-2 or alpha-3) | `country_code` |
| [hex_color](rules.md#hex_color) | `HexColor` | Validate CSS hex color codes (3, 4, 6, or 8 digits) | `hex_color` |
| [latitude](rules.md#latitude) | `Latitude` | Validate numeric coordinate between -90 and 90 degrees | `latitude` |
| [longitude](rules.md#longitude) | `Longitude` | Validate numeric coordinate between -180 and 180 degrees | `longitude` |
| [cidr](rules.md#cidr) | `Cidr` | Validate IPv4 or IPv6 CIDR subnet notations | `cidr` / `cidr:v4` / `cidr:v6` |
| [email_domain](rules.md#email_domain) | `EmailDomain` | Validate email domain against allowed or blocked lists | `email_domain` |
| [not_hashed](rules.md#not_hashed) | `NotHashed` | Ensure string is not already a bcrypt/argon hashed password | `not_hashed` |
| [alpha_underscore](rules.md#alpha_underscore) | `AlphaUnderscore` | Ensure string contains only letters, numbers, and underscores | `alpha_underscore` |
| [unless_between](rules.md#unless_between) | `UnlessBetween` | Ensure numeric value falls outside a specified range | `unless_between:min,max` |
| [without_whitespace](rules.md#without_whitespace) | `WithoutWhitespace` | Ensure input does not contain any whitespace characters | `without_whitespace` |
| [no_html](rules.md#no_html) | `NoHtml` | Ensure input does not contain HTML tags | `no_html` |
| [url_protocol](rules.md#url_protocol) | `UrlProtocol` | Validate URL scheme against allowed protocols | `url_protocol:https,sftp` |
| [snake_case](rules.md#snake_case) | `SnakeCase` | Validate strict snake_case string formatting | `snake_case` |
| [multiple_of](rules.md#multiple_of) | `MultipleOf` | Ensure numeric value is an exact multiple of a step | `multiple_of:step` |
| [alpha_num_ascii](rules.md#alpha_num_ascii) | `AlphaNumAscii` | Validate strict ASCII-only alphanumeric characters | `alpha_num_ascii` |

## Why this package exists

This package started when I submitted a pull request ([PR #61522](https://github.com/laravel/framework/pull/61522)) to the Laravel framework to add a validation rule for rejecting plus-addressed email aliases (such as `username+tag@gmail.com`). The goal was to help applications prevent trial abuse and duplicate account creation.

The pull request was closed because plus-addressing is technically valid per RFC 5322, and the Laravel core team prioritizes keeping built-in validation rules strictly aligned with RFC standards while keeping framework core lean.

That prompted a closer look at other validation pull requests closed across the framework repository over the years. Many addressed practical application needs, such as verifying slugs, SemVer strings, Luhn checksums, or word counts, but were kept out of core to prevent framework bloat. This package gathers those useful validation rules together in one place, built the Laravel way. See the [Acknowledgements](acknowledgements.md) page for the complete list of community pull requests that inspired these rules.

## Next steps

- [Installation](installation.md): requirements and auto-discovery.
- [Configuration](configuration.md): enable or disable specific rules.
- [Usage](usage.md): class syntax, Rule macros, and string rules.
- [Rules reference](rules.md): full documentation and code examples for each rule.
- [Acknowledgements](acknowledgements.md): community pull requests and credits.


---

# Rules Reference

> Complete reference and usage examples for all 28 validation rules in mrpunyapal/laravel-extended-validation.

# Rules Reference

Complete reference for all 28 validation rules included in the package.

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

---

## latitude

Validates that a numeric coordinate represents a valid latitude between `-90` and `90` degrees (inclusive).

- **Class**: `MrPunyapal\LaravelExtendedValidation\Rules\Latitude`
- **Macro**: `Rule::latitude()`
- **String**: `latitude`

### Usage

```php
use MrPunyapal\LaravelExtendedValidation\Rules\Latitude;
use Illuminate\Validation\Rule;

'lat' => ['required', new Latitude]
'lat' => ['required', Rule::latitude()]
'lat' => 'required|latitude'
```

### Examples

| Input | Result |
| --- | --- |
| `0` | Passes |
| `37.7749` | Passes |
| `-90`, `90` | Passes |
| `90.0001` | Fails |
| `-91` | Fails |
| `'not-a-number'` | Fails |

---

## longitude

Validates that a numeric coordinate represents a valid longitude between `-180` and `180` degrees (inclusive).

- **Class**: `MrPunyapal\LaravelExtendedValidation\Rules\Longitude`
- **Macro**: `Rule::longitude()`
- **String**: `longitude`

### Usage

```php
use MrPunyapal\LaravelExtendedValidation\Rules\Longitude;
use Illuminate\Validation\Rule;

'lng' => ['required', new Longitude]
'lng' => ['required', Rule::longitude()]
'lng' => 'required|longitude'
```

### Examples

| Input | Result |
| --- | --- |
| `0` | Passes |
| `-122.4194` | Passes |
| `-180`, `180` | Passes |
| `180.0001` | Fails |
| `-181` | Fails |
| `'not-a-number'` | Fails |

---

## cidr

Validates that a string is a valid Classless Inter-Domain Routing (CIDR) subnet notation block. Supports IPv4, IPv6, or either.

- **Class**: `MrPunyapal\LaravelExtendedValidation\Rules\Cidr`
- **Macro**: `Rule::cidr(?string $version = null)`
- **String**: `cidr`, `cidr:v4`, or `cidr:v6`

### Usage

```php
use MrPunyapal\LaravelExtendedValidation\Rules\Cidr;
use Illuminate\Validation\Rule;

// IPv4 or IPv6
'subnet' => ['required', new Cidr]
'subnet' => ['required', Rule::cidr()]
'subnet' => 'required|cidr'

// IPv4 only
'subnet' => ['required', new Cidr('v4')]
'subnet' => ['required', Rule::cidr('v4')]
'subnet' => 'required|cidr:v4'

// IPv6 only
'subnet' => ['required', new Cidr('v6')]
'subnet' => ['required', Rule::cidr('v6')]
'subnet' => 'required|cidr:v6'
```

### Examples

| Input | Result |
| --- | --- |
| `192.168.1.0/24` | Passes (IPv4) |
| `10.0.0.0/8` | Passes (IPv4) |
| `2001:db8::/32` | Passes (IPv6) |
| `192.168.1.0/33` | Fails (invalid prefix) |
| `192.168.1.0` | Fails (missing prefix length) |
| `not-a-cidr` | Fails |

---

## email_domain

Validates that an email address belongs to an allowed domain list or does not belong to a blocked domain list.

- **Class**: `MrPunyapal\LaravelExtendedValidation\Rules\EmailDomain`
- **Macro**: `Rule::emailDomain($allowed = [], $blocked = [])`
- **String**: `email_domain`

### Usage

```php
use MrPunyapal\LaravelExtendedValidation\Rules\EmailDomain;
use Illuminate\Validation\Rule;

// Allow specific company domains
'email' => ['required', 'email', EmailDomain::allowed('company.com', 'partner.org')]
'email' => ['required', 'email', Rule::emailDomain(allowed: ['company.com', 'partner.org'])]

// Block disposable email providers
'email' => ['required', 'email', EmailDomain::blocked('mailinator.com', 'tempmail.com')]
'email' => ['required', 'email', Rule::emailDomain(blocked: ['mailinator.com', 'tempmail.com'])]
```

### Examples

| Input | Configuration | Result |
| --- | --- | --- |
| `alice@company.com` | `allowed: ['company.com']` | Passes |
| `alice@gmail.com` | `allowed: ['company.com']` | Fails |
| `bob@legit.com` | `blocked: ['tempmail.com']` | Passes |
| `bob@tempmail.com` | `blocked: ['tempmail.com']` | Fails |

---

## not_hashed

Ensures that a password field is not already passed as an algorithm hash (such as bcrypt or argon). Useful for preventing users or clients from submitting pre-hashed strings when registration or password resets expect plain text to hash on the server.

- **Class**: `MrPunyapal\LaravelExtendedValidation\Rules\NotHashed`
- **Macro**: `Rule::notHashed()`
- **String**: `not_hashed`

### Usage

```php
use MrPunyapal\LaravelExtendedValidation\Rules\NotHashed;
use Illuminate\Validation\Rule;

'password' => ['required', 'string', 'min:8', new NotHashed]
'password' => ['required', 'string', 'min:8', Rule::notHashed()]
'password' => 'required|string|min:8|not_hashed'
```

### Examples

| Input | Result |
| --- | --- |
| `P@ssw0rd123!` | Passes |
| `my-secret-password` | Passes |
| `$2y$10$e80yq9k...` (bcrypt hash) | Fails |
| `$argon2id$v=19$...` (argon hash) | Fails |

---

## alpha_underscore

Validates that a string contains only letters, numbers, and underscores (`_`). Unlike Laravel's native `alpha_dash` which also permits hyphens (`-`), `alpha_underscore` enforces strict identifier naming (like Python or SQL identifiers and usernames).

- **Class**: `MrPunyapal\LaravelExtendedValidation\Rules\AlphaUnderscore`
- **Macro**: `Rule::alphaUnderscore()`
- **String**: `alpha_underscore`

### Usage

```php
use MrPunyapal\LaravelExtendedValidation\Rules\AlphaUnderscore;
use Illuminate\Validation\Rule;

'username' => ['required', 'string', new AlphaUnderscore]
'username' => ['required', 'string', Rule::alphaUnderscore()]
'username' => 'required|string|alpha_underscore'
```

### Examples

| Input | Result |
| --- | --- |
| `user_123` | Passes |
| `USER_NAME` | Passes |
| `_system_` | Passes |
| `user-name` | Fails (hyphen not allowed) |
| `user name` | Fails (space not allowed) |
| `user@name` | Fails (symbol not allowed) |

---

## unless_between

Validates that a numeric value falls outside a specified range (i.e. value < min OR value > max).

- **Class**: `MrPunyapal\LaravelExtendedValidation\Rules\UnlessBetween`
- **Macro**: `Rule::unlessBetween(float|int $min, float|int $max)`
- **String**: `unless_between:{min},{max}`

### Usage

```php
use MrPunyapal\LaravelExtendedValidation\Rules\UnlessBetween;
use Illuminate\Validation\Rule;

'discount' => ['required', new UnlessBetween(10, 20)]
'discount' => ['required', Rule::unlessBetween(10, 20)]
'discount' => 'required|unless_between:10,20'
```

### Examples

| Input | Range | Result |
| --- | --- | --- |
| `5` | `10, 20` | Passes |
| `25` | `10, 20` | Passes |
| `10` | `10, 20` | Fails (inside boundary) |
| `15` | `10, 20` | Fails (inside range) |
| `20` | `10, 20` | Fails (inside boundary) |

---

## without_whitespace

Validates that an input string does not contain any whitespace characters (spaces, tabs, or newlines).

- **Class**: `MrPunyapal\LaravelExtendedValidation\Rules\WithoutWhitespace`
- **Macro**: `Rule::withoutWhitespace()`
- **String**: `without_whitespace`

### Usage

```php
use MrPunyapal\LaravelExtendedValidation\Rules\WithoutWhitespace;
use Illuminate\Validation\Rule;

'token' => ['required', new WithoutWhitespace]
'token' => ['required', Rule::withoutWhitespace()]
'token' => 'required|without_whitespace'
```

### Examples

| Input | Result |
| --- | --- |
| `username` | Passes |
| `token_12345` | Passes |
| `hello world` | Fails (contains space) |
| `"hello\tworld"` | Fails (contains tab) |
| `"hello\nworld"` | Fails (contains newline) |

---

## no_html

Validates that an input string contains no HTML or XML tags.

- **Class**: `MrPunyapal\LaravelExtendedValidation\Rules\NoHtml`
- **Macro**: `Rule::noHtml()`
- **String**: `no_html`

### Usage

```php
use MrPunyapal\LaravelExtendedValidation\Rules\NoHtml;
use Illuminate\Validation\Rule;

'comment' => ['required', 'string', new NoHtml]
'comment' => ['required', 'string', Rule::noHtml()]
'comment' => 'required|string|no_html'
```

### Examples

| Input | Result |
| --- | --- |
| `Plain text comment` | Passes |
| `Ben & Jerry's` | Passes |
| `formula: 3 < 5 and 6 > 2` | Passes |
| `<p>Hello world</p>` | Fails |
| `<script>alert(1)</script>` | Fails |
| `<img src="x" onerror="alert(1)">` | Fails |

---

## url_protocol

Validates that a URL string uses one of the specified protocol schemes.

- **Class**: `MrPunyapal\LaravelExtendedValidation\Rules\UrlProtocol`
- **Macro**: `Rule::urlProtocol(array|string ...$protocols)`
- **String**: `url_protocol:{protocol1},{protocol2}`

### Usage

```php
use MrPunyapal\LaravelExtendedValidation\Rules\UrlProtocol;
use Illuminate\Validation\Rule;

'website' => ['required', new UrlProtocol('https')]
'website' => ['required', Rule::urlProtocol('https', 'http')]
'website' => 'required|url_protocol:https,http'
```

### Examples

| Input | Allowed | Result |
| --- | --- | --- |
| `https://laravel.com` | `['https', 'http']` | Passes |
| `http://example.com` | `['https', 'http']` | Passes |
| `ftp://files.example.com` | `['https']` | Fails |
| `javascript:alert(1)` | `['https']` | Fails |

---

## snake_case

Validates that a string is strictly formatted in snake_case (lowercase alphanumeric characters separated by single underscores).

- **Class**: `MrPunyapal\LaravelExtendedValidation\Rules\SnakeCase`
- **Macro**: `Rule::snakeCase()`
- **String**: `snake_case`

### Usage

```php
use MrPunyapal\LaravelExtendedValidation\Rules\SnakeCase;
use Illuminate\Validation\Rule;

'column_name' => ['required', new SnakeCase]
'column_name' => ['required', Rule::snakeCase()]
'column_name' => 'required|snake_case'
```

### Examples

| Input | Result |
| --- | --- |
| `user_name` | Passes |
| `first_name_id` | Passes |
| `slug` | Passes |
| `UserName` | Fails (uppercase letters) |
| `user-name` | Fails (hyphens not allowed) |
| `user__name` | Fails (consecutive underscores) |
| `_user_name` | Fails (leading underscore) |

---

## multiple_of

Validates that a numeric value is an exact multiple of a given step.

- **Class**: `MrPunyapal\LaravelExtendedValidation\Rules\MultipleOf`
- **Macro**: `Rule::multipleOf(int|float $step)`
- **String**: `multiple_of:{step}`

### Usage

```php
use MrPunyapal\LaravelExtendedValidation\Rules\MultipleOf;
use Illuminate\Validation\Rule;

'quantity' => ['required', new MultipleOf(5)]
'quantity' => ['required', Rule::multipleOf(5)]
'quantity' => 'required|multiple_of:5'

// Floating point increments
'price' => ['required', new MultipleOf(0.25)]
```

### Examples

| Input | Step | Result |
| --- | --- | --- |
| `5`, `10`, `15`, `0`, `-5` | `5` | Passes |
| `0.50`, `1.25`, `2.00` | `0.25` | Passes |
| `7` | `5` | Fails |
| `0.30` | `0.25` | Fails |

---

## alpha_num_ascii

Validates that an input contains only standard ASCII alphanumeric characters (`a-z`, `A-Z`, `0-9`), rejecting multi-byte characters and Unicode homoglyphs.

- **Class**: `MrPunyapal\LaravelExtendedValidation\Rules\AlphaNumAscii`
- **Macro**: `Rule::alphaNumAscii()`
- **String**: `alpha_num_ascii`

### Usage

```php
use MrPunyapal\LaravelExtendedValidation\Rules\AlphaNumAscii;
use Illuminate\Validation\Rule;

'code' => ['required', new AlphaNumAscii]
'code' => ['required', Rule::alphaNumAscii()]
'code' => 'required|alpha_num_ascii'
```

### Examples

| Input | Result |
| --- | --- |
| `abcXYZ123` | Passes |
| `User42` | Passes |
| `user_name` | Fails (symbols not allowed) |
| `café` | Fails (non-ASCII character `é`) |
| `über` | Fails (non-ASCII character `ü`) |
| `こんにちは` | Fails (non-ASCII characters) |




---

# Usage

> Learn the three syntax options for applying extended validation rules in Laravel applications.

# Usage

Every rule in this package supports three usage patterns: class instances, fluent macros on the `Rule` facade, and pipe-delimited string rules.

## 1. Class instance syntax (Recommended)

Instantiate rule objects directly or call their static `make()` method. This provides full IDE auto-completion and static analysis:

```php
use MrPunyapal\LaravelExtendedValidation\Rules\WithoutAlias;
use MrPunyapal\LaravelExtendedValidation\Rules\NotEmail;
use MrPunyapal\LaravelExtendedValidation\Rules\Slug;

$request->validate([
    'email'    => ['required', 'email', new WithoutAlias],
    'username' => ['required', 'string', new NotEmail],
    'slug'     => ['required', Slug::make()],
]);
```

Pass constructor parameters to customize rule behavior:

```php
use MrPunyapal\LaravelExtendedValidation\Rules\Slug;
use MrPunyapal\LaravelExtendedValidation\Rules\MinWords;
use MrPunyapal\LaravelExtendedValidation\Rules\Base64String;

$request->validate([
    'slug'   => ['required', new Slug('_')],
    'bio'    => ['required', new MinWords(50)],
    'avatar' => ['required', new Base64String('image/png', 'image/jpeg')],
]);
```

## 2. Fluent Rule macro syntax

The package registers camelCase macros on Laravel's `Illuminate\Validation\Rule` class:

```php
use Illuminate\Validation\Rule;

$request->validate([
    'email'    => ['required', 'email', Rule::withoutAlias()],
    'username' => ['required', 'string', Rule::notEmail()],
    'slug'     => ['required', Rule::slug()],
    'phone'    => ['required', Rule::e164()],
    'bio'      => ['required', Rule::minWords(20)],
    'country'  => ['required', Rule::countryCode('alpha3')],
]);
```

## 3. String syntax

Use standard string rules for concise validation arrays or form request definitions:

```php
$request->validate([
    'email'    => 'required|email|without_alias',
    'username' => 'required|string|not_email',
    'slug'     => 'required|slug',
    'phone'    => 'required|e164',
    'version'  => 'required|semver',
    'color'    => 'required|hex_color',
]);
```

Rules with parameters accept them via colon separation:

```php
$request->validate([
    'slug'    => 'required|slug:_',
    'country' => 'required|country_code:alpha3',
    'isbn'    => 'required|isbn:13',
    'bio'     => 'required|min_words:25',
]);
```

## Customizing error messages

### Inline messages

Override messages directly when calling `$request->validate()` or inside a form request `messages()` method:

```php
$request->validate([
    'email' => ['required', 'email', Rule::withoutAlias()],
], [
    'email.without_alias' => 'Please provide a direct email address without aliases.',
]);
```

### Translation files

Publish the package translations to customize messages application-wide:

```bash
php artisan vendor:publish --tag="laravel-extended-validation-translations"
```

Edit `lang/vendor/laravel-extended-validation/en/validation.php`:

```php
return [
    'without_alias' => 'The :attribute must not contain a plus-alias.',
    'not_email'     => 'The :attribute cannot be an email address.',
    // ...
];
```

## Next steps

- Explore all 15 rules with input examples in the [Rules reference](rules.md).

