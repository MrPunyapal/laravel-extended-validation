# Laravel Extended Validation

[![Latest Version on Packagist](https://img.shields.io/packagist/v/mrpunyapal/laravel-extended-validation.svg?style=flat-square)](https://packagist.org/packages/mrpunyapal/laravel-extended-validation)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/mrpunyapal/laravel-extended-validation/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/mrpunyapal/laravel-extended-validation/actions?query=workflow%3Arun-tests+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/mrpunyapal/laravel-extended-validation.svg?style=flat-square)](https://packagist.org/packages/mrpunyapal/laravel-extended-validation)

A collection of 15 validation rules for Laravel applications. Every rule works in three ways: as an invokable rule class, as a fluent `Rule::` macro, and as a standard string rule.

## Quick start

Install the package via Composer:

```bash
composer require mrpunyapal/laravel-extended-validation
```

Use rules with class syntax, fluent macros, or pipe-delimited strings:

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

## Why this package exists

This package started when I submitted a pull request ([PR #61522](https://github.com/laravel/framework/pull/61522)) to the Laravel framework to add a validation rule for rejecting plus-addressed email aliases (such as `username+tag@gmail.com`) to prevent trial abuse and duplicate account creation.

The pull request was closed because plus-addressing is valid per RFC 5322, and the Laravel core team prioritizes keeping built-in validation rules strictly aligned with RFC standards while keeping framework core lean.

That prompted a closer look at other validation pull requests closed across the framework repository over the years. Many addressed practical real-world needs (such as verifying slugs, SemVer strings, Luhn checksums, or word counts), but were kept out of core to prevent framework bloat. This package gathers those useful validation rules together in one place, built the Laravel way.

## Available rules

| Rule | Class | Description | Syntax |
| --- | --- | --- | --- |
| `without_alias` | `WithoutAlias` | Reject plus-addressed email aliases (`user+tag@gmail.com`) | `without_alias` |
| `not_email` | `NotEmail` | Ensure a value is not an email address | `not_email` |
| `slug` | `Slug` | Validate clean URL slugs with configurable separator | `slug` / `slug:_` |
| `even` | `EvenNumber` | Ensure numeric input is an even integer | `even` |
| `odd` | `OddNumber` | Ensure numeric input is an odd integer | `odd` |
| `semver` | `Semver` | Validate Semantic Versioning 2.0.0 strings | `semver` |
| `base64_string` | `Base64String` | Validate base64 strings and data URIs with optional MIME filters | `base64_string` |
| `luhn` | `Luhn` | Validate numeric strings against the Luhn/MOD-10 checksum | `luhn` |
| `min_words` | `MinWords` | Validate minimum word count | `min_words:N` |
| `max_words` | `MaxWords` | Validate maximum word count | `max_words:N` |
| `domain` | `Domain` | Validate domain names without requiring protocols | `domain` |
| `e164` | `E164Phone` | Validate international phone numbers in E.164 format | `e164` |
| `isbn` | `Isbn` | Validate ISBN-10, ISBN-13, or both with checksums | `isbn` / `isbn:10` / `isbn:13` |
| `country_code` | `CountryCode` | Validate ISO 3166-1 country codes (alpha-2 or alpha-3) | `country_code` |
| `hex_color` | `HexColor` | Validate CSS hex color codes (3, 4, 6, or 8 digits) | `hex_color` |

## Three ways to use every rule

### 1. Class instance syntax (Recommended)

Direct instantiation provides full IDE autocomplete, type safety, and static analysis:

```php
use MrPunyapal\LaravelExtendedValidation\Rules\WithoutAlias;
use MrPunyapal\LaravelExtendedValidation\Rules\Slug;
use MrPunyapal\LaravelExtendedValidation\Rules\MinWords;

$request->validate([
    'email' => ['required', 'email', new WithoutAlias],
    'slug'  => ['required', new Slug('_')],
    'bio'   => ['required', new MinWords(50)],
]);
```

### 2. Fluent Rule macro syntax

All rules are available as camelCase macros on `Illuminate\Validation\Rule`:

```php
use Illuminate\Validation\Rule;

$request->validate([
    'email'    => ['required', 'email', Rule::withoutAlias()],
    'username' => ['required', 'string', Rule::notEmail()],
    'slug'     => ['required', Rule::slug()],
    'phone'    => ['required', Rule::e164()],
    'country'  => ['required', Rule::countryCode('alpha3')],
]);
```

### 3. String syntax

Use pipe-delimited string rules for concise form requests:

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

## Configuration

Publish the configuration file to selectively enable or disable individual rules:

```bash
php artisan vendor:publish --tag="laravel-extended-validation-config"
```

## Localization

Publish the translation files to customize error messages:

```bash
php artisan vendor:publish --tag="laravel-extended-validation-translations"
```

## Laravel Boost

This package ships a Laravel Boost skill named `laravel-extended-validation-development` for on-demand AI guidance.

If your Laravel application uses Boost, discover the skill with:

```bash
php artisan boost:update --discover
```

## Testing

```bash
composer test
```

## Documentation

Full documentation is available at [https://mrpunyapal.github.io/laravel-extended-validation](https://mrpunyapal.github.io/laravel-extended-validation).

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on recent changes.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
