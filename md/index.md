---
title: Laravel Extended Validation
description: A collection of 22 useful validation rules for Laravel applications, available as rule classes, fluent Rule macros, and string rules.
---

# Laravel Extended Validation

A collection of 22 validation rules for Laravel applications. Every rule works in three ways: as an invokable rule class, as a fluent `Rule::` macro, and as a classic string rule.

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
