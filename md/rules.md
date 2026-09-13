---
title: Rules Reference
description: Complete reference and usage examples for all 28 validation rules in mrpunyapal/laravel-extended-validation.
---

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


