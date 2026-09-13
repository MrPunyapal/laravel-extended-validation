# Laravel Extended Validation

[![Latest Version on Packagist](https://img.shields.io/packagist/v/mrpunyapal/laravel-extended-validation.svg?style=flat-square)](https://packagist.org/packages/mrpunyapal/laravel-extended-validation)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/mrpunyapal/laravel-extended-validation/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/mrpunyapal/laravel-extended-validation/actions?query=workflow%3Arun-tests+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/mrpunyapal/laravel-extended-validation.svg?style=flat-square)](https://packagist.org/packages/mrpunyapal/laravel-extended-validation)

A collection of **15 useful validation rules** that were proposed to Laravel core but rejected — now available as a clean, well-tested package. Every rule works three ways: as a class, as a `Rule::` macro, and as a string rule.

## Why this package?

I submitted a pull request ([laravel/framework#61522](https://github.com/laravel/framework/pull/61522)) to the Laravel framework to add an option rejecting plus-addressed email aliases (e.g. `username+alias@gmail.com`) to prevent users from creating multiple accounts or abusing trials. The PR was rejected because plus-addressing is RFC 5322 compliant, and Laravel core maintains strict RFC compliance for email validation rather than adding anti-abuse rules.

That got me thinking: *what other useful validation rules have been proposed to the framework over the years and rejected?*

I looked through closed and rejected validation PRs on the `laravel/framework` repository, picked the most useful ones that real-world applications actually need, and implemented them all in this package the Laravel way!

## Installation

```bash
composer require mrpunyapal/laravel-extended-validation
```

## Available Rules

### `slug` — URL-Friendly Slug
Validates that a string is a clean, URL-friendly slug. Rejects uppercase, spaces, special characters, consecutive/leading/trailing separators.

> **Rejected in [laravel/framework#38706](https://github.com/laravel/framework/pull/38706)** — *"You can use regex or a custom rule for this."*

```php
// Class syntax
'slug' => ['required', new Slug]
'slug' => ['required', new Slug('_')]  // custom separator

// Rule macro
'slug' => ['required', Rule::slug()]

// String syntax
'slug' => 'required|slug'
```

---

### `even` / `odd` — Even & Odd Numbers
Validates whether a numeric value is even or odd.

> **Rejected in [laravel/framework#43632](https://github.com/laravel/framework/pull/43632)** — *"Feel free to use a custom rule for this."*

```php
'quantity' => ['required', new EvenNumber]
'seat'     => ['required', Rule::odd()]
```

---

### `semver` — Semantic Versioning
Validates [SemVer 2.0.0](https://semver.org) strings including pre-release and build metadata.

> **Rejected in [laravel/framework#36854](https://github.com/laravel/framework/pull/36854)** — Too niche for framework core.

```php
'version' => ['required', new Semver]
'version' => ['required', Rule::semver()]
'version' => 'required|semver'
```

---

### `base64_string` — Base64 Encoded Data
Validates base64 strings with optional MIME type filtering for data URIs.

> **Rejected in [laravel/framework#41528](https://github.com/laravel/framework/pull/41528)** — Memory/DoS concerns with decoding in validation.

```php
'data'   => ['required', new Base64String]
'avatar' => ['required', new Base64String('image/png', 'image/jpeg')]
```

---

### `luhn` — Luhn/MOD-10 Checksum
Validates numeric strings against the Luhn algorithm (credit cards, IMEI, national IDs).

> **Rejected in [laravel/framework#31422](https://github.com/laravel/framework/pull/31422)** — PCI-DSS compliance concerns.

```php
'card_number' => ['required', new Luhn]
'card_number' => ['required', Rule::luhn()]
```

---

### `min_words` / `max_words` — Word Count
Validates minimum or maximum word count for text content.

> **Rejected in [laravel/framework#35108](https://github.com/laravel/framework/pull/35108)** — `str_word_count()` doesn't support CJK/Unicode.

```php
'essay'   => ['required', new MinWords(100)]
'summary' => ['required', new MaxWords(50)]
```

---

### `domain` — Domain Name
Validates domain names without requiring a URL protocol scheme.

> **Rejected in [laravel/framework#38954](https://github.com/laravel/framework/pull/38954)** — Too many IDN edge cases.

```php
'website' => ['required', new Domain]
'website' => ['required', Rule::domain()]
```

---

### `e164` — E.164 Phone Number
Validates international phone numbers in E.164 format (`+` followed by 2–15 digits).

> **Rejected in [laravel/framework#48332](https://github.com/laravel/framework/pull/48332)** — Simple enough for regex; real validation needs libphonenumber.

```php
'phone' => ['required', new E164Phone]
'phone' => ['required', Rule::e164()]
'phone' => 'required|e164'
```

---

### `isbn` — ISBN-10 / ISBN-13
Validates International Standard Book Numbers with proper checksum verification.

> **Rejected in [laravel/framework#37652](https://github.com/laravel/framework/pull/37652)** — Too domain-specific for core.

```php
'book'   => ['required', new Isbn]        // accepts both
'book10' => ['required', new Isbn('10')]   // ISBN-10 only
'book13' => ['required', new Isbn('13')]   // ISBN-13 only
```

---

### `country_code` — ISO 3166-1 Country Code
Validates ISO 3166-1 alpha-2 country codes (249 codes).

> **Rejected in [laravel/framework#42110](https://github.com/laravel/framework/pull/42110)** — Static data maintenance burden.

```php
'country' => ['required', new CountryCode]
'country' => ['required', Rule::countryCode()]
'country' => 'required|country_code'
```

---

### `hex_color` — Hex Color Code
Validates CSS hex color codes (3, 4, 6, or 8 character formats).

```php
'color' => ['required', new HexColor]
'color' => ['required', Rule::hexColor()]
'color' => 'required|hex_color'
```

---

### `without_alias` — Email Without Plus Alias
Validates that an email doesn't contain plus sub-addressing (e.g. `user+tag@gmail.com`).

> **Rejected in [laravel/framework#61522](https://github.com/laravel/framework/pull/61522)** — Plus addressing is valid per RFC 5322.

```php
'email' => ['required', 'email', new WithoutAlias]
'email' => ['required', 'email', Rule::withoutAlias()]
```

---

### `not_email` — Not an Email Address
Validates that a string is NOT a valid email address. Great for username fields.

> **Rejected in [laravel/framework#60915](https://github.com/laravel/framework/pull/60915)** — Slippery slope for "not_*" rules.

```php
'username' => ['required', 'string', new NotEmail]
'username' => ['required', 'string', Rule::notEmail()]
```

---

## Three Ways to Use Every Rule

```php
// 1. Class syntax (recommended for IDE support)
'field' => ['required', new Slug]

// 2. Rule macro syntax (fluent API)
'field' => ['required', Rule::slug()]

// 3. String syntax (classic Laravel)
'field' => 'required|slug'
```

## Configuration

Publish the config file to enable/disable specific rules:

```bash
php artisan vendor:publish --tag="laravel-extended-validation-config"
```

## Localization

Publish the translation files to customize error messages:

```bash
php artisan vendor:publish --tag="laravel-extended-validation-translations"
```

## Laravel Boost

The package ships a Laravel Boost skill named `laravel-extended-validation-development` for on-demand AI guidance when using these extended validation rules.

If your Laravel application uses Boost, discover the new package skills:

```bash
php artisan boost:update --discover
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
