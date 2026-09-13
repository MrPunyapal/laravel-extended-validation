---
name: laravel-extended-validation-development
description: "Use this skill when working with mrpunyapal/laravel-extended-validation in a Laravel application. Trigger when adding or configuring extended validation rules for plus-alias email rejection (without_alias), username non-email validation (not_email), URL slugs (slug), even/odd integers (even, odd), semantic versions (semver), base64 data URIs (base64_string), Luhn MOD-10 checksums (luhn), word count limits (min_words, max_words), domain names (domain), E.164 phone numbers (e164), ISBN codes (isbn), ISO 3166-1 country codes (country_code), or hex colors (hex_color). Covers rule class syntax, Rule fluent macros, and string rule syntax."
license: MIT
metadata:
  author: mrpunyapal
---

# Laravel Extended Validation Development

## When to use this skill

Use this skill when a Laravel request validation or form request needs specialized validation rules that were rejected from Laravel framework core but provided by `mrpunyapal/laravel-extended-validation`.

Typical triggers:
- Blocking plus-addressing/email aliases (`user+test@gmail.com`) to prevent trial abuse or duplicate accounts (`without_alias` / `WithoutAlias`)
- Ensuring a username or text field is NOT an email address to avoid login collisions (`not_email` / `NotEmail`)
- Validating clean URL slugs (`slug` / `Slug`)
- Validating even or odd integer inputs (`even`, `odd` / `EvenNumber`, `OddNumber`)
- Validating Semantic Versioning 2.0.0 strings (`semver` / `Semver`)
- Validating Base64 payloads and Data URIs with MIME type restrictions (`base64_string` / `Base64String`)
- Validating credit card, IMEI, or national ID checksums with the Luhn MOD-10 algorithm (`luhn` / `Luhn`)
- Validating minimum or maximum word counts (`min_words`, `max_words` / `MinWords`, `MaxWords`)
- Validating domain names / FQDNs without requiring http/https protocols (`domain` / `Domain`)
- Validating international E.164 telephone numbers (`e164` / `E164Phone`)
- Validating ISBN-10, ISBN-13, or both (`isbn` / `Isbn`)
- Validating ISO 3166-1 alpha-2 or alpha-3 country codes (`country_code` / `CountryCode`)
- Validating CSS hex color codes (`hex_color` / `HexColor`)

## Three Syntax Styles

Every rule supports three syntax styles. Recommend class syntax for IDE type-safety or macro syntax for clean fluent rules:

### 1. Class Instance Syntax (Recommended)

```php
use MrPunyapal\LaravelExtendedValidation\Rules\WithoutAlias;
use MrPunyapal\LaravelExtendedValidation\Rules\NotEmail;
use MrPunyapal\LaravelExtendedValidation\Rules\Slug;
use MrPunyapal\LaravelExtendedValidation\Rules\E164Phone;

$request->validate([
    'email'    => ['required', 'email', new WithoutAlias],
    'username' => ['required', 'string', new NotEmail],
    'slug'     => ['required', new Slug],
    'phone'    => ['required', new E164Phone],
]);
```

### 2. Fluent Rule Macro Syntax

```php
use Illuminate\Validation\Rule;

$request->validate([
    'email'    => ['required', 'email', Rule::withoutAlias()],
    'username' => ['required', 'string', Rule::notEmail()],
    'slug'     => ['required', Rule::slug()],
    'phone'    => ['required', Rule::e164()],
    'bio'      => ['required', Rule::minWords(25)],
    'country'  => ['required', Rule::countryCode('alpha3')],
]);
```

### 3. String Rule Syntax

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

## Quick Rule Reference

| Rule | Class | Macro | String | Example Usage |
|---|---|---|---|---|
| Without Alias | `WithoutAlias` | `Rule::withoutAlias()` | `without_alias` | Rejects `user+tag@gmail.com` |
| Not Email | `NotEmail` | `Rule::notEmail()` | `not_email` | Rejects valid email strings |
| Slug | `Slug` | `Rule::slug($sep = '-')` | `slug` / `slug:_` | `my-awesome-post` |
| Even | `EvenNumber` | `Rule::even()` | `even` | `2`, `4`, `42` |
| Odd | `OddNumber` | `Rule::odd()` | `odd` | `1`, `3`, `99` |
| Semver | `Semver` | `Rule::semver()` | `semver` | `1.0.0`, `2.1.0-beta.1` |
| Base64 | `Base64String` | `Rule::base64String(...$mimes)` | `base64_string` | Encoded strings or Data URIs |
| Luhn | `Luhn` | `Rule::luhn()` | `luhn` | Mod-10 checksum (cards, IMEI) |
| Min Words | `MinWords` | `Rule::minWords(int $min)` | `min_words:N` | `str_word_count >= N` |
| Max Words | `MaxWords` | `Rule::maxWords(int $max)` | `max_words:N` | `str_word_count <= N` |
| Domain | `Domain` | `Rule::domain()` | `domain` | `example.com` (no protocol) |
| E.164 | `E164Phone` | `Rule::e164()` | `e164` | `+14155552671` |
| ISBN | `Isbn` | `Rule::isbn(?string $type = null)` | `isbn` / `isbn:10` / `isbn:13` | ISBN-10 or ISBN-13 checksum |
| Country Code | `CountryCode` | `Rule::countryCode($format = 'alpha2')` | `country_code` / `country_code:alpha3` | ISO 3166-1 `US`, `GB`, `USA` |
| Hex Color | `HexColor` | `Rule::hexColor()` | `hex_color` | `#fff`, `#ffffff`, `#ffffffff` |

## Configuration

Rules can be enabled/disabled in `config/extended-validation.php`. Publish with:

```bash
php artisan vendor:publish --tag="laravel-extended-validation-config"
```

## Translations

Error messages are localized under `laravel-extended-validation::validation.{rule}`. Publish with:

```bash
php artisan vendor:publish --tag="laravel-extended-validation-translations"
```
