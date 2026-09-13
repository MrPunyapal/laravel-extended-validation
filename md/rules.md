# Rules Reference

Complete reference for all 15 validation rules included in the package.

---

## without_alias

Validates that an email address does not contain a plus sub-addressing alias (e.g. `user+tag@gmail.com`).

- **Class**: `MrPunyapal\LaravelExtendedValidation\Rules\WithoutAlias`
- **Macro**: `Rule::withoutAlias()`
- **String**: `without_alias`
- **Rejected in**: [laravel/framework#61522](https://github.com/laravel/framework/pull/61522)
- **Why rejected**: RFC 5322 explicitly allows `+` in email local-parts; core maintainers keep email validation strictly aligned with the RFC, leaving abuse prevention to userland.

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

### Passes / Fails

- Passes: `user@example.com`, `john.doe@gmail.com`, `team@sub.domain.co.uk`
- Fails: `user+test@example.com`, `john+promo@gmail.com`, `+user@example.com`, `user+@example.com`

---

## not_email

Validates that a given string is **not** a valid email address. Essential for applications that allow sign-in with "Username or Email" to prevent account collisions.

- **Class**: `MrPunyapal\LaravelExtendedValidation\Rules\NotEmail`
- **Macro**: `Rule::notEmail()`
- **String**: `not_email`
- **Rejected in**: [laravel/framework#60915](https://github.com/laravel/framework/pull/60915)
- **Why rejected**: Laravel core avoids adding negated variants (`not_*`) to prevent a slippery slope of negative rule duplication.

### Usage

```php
use MrPunyapal\LaravelExtendedValidation\Rules\NotEmail;
use Illuminate\Validation\Rule;

// Prevent users from choosing an email address as their username
'username' => ['required', 'string', 'min:3', 'max:30', new NotEmail]
'username' => ['required', 'string', Rule::notEmail()]
'username' => 'required|string|not_email'
```

### Passes / Fails

- Passes: `johndoe`, `cool-dev_42`, `hello world`
- Fails: `user@example.com`, `john@gmail.com`, `admin@domain.io`

---

## slug

Validates that a string is a clean, URL-friendly slug. Rejects uppercase letters, whitespace, special characters, and consecutive or leading/trailing separators.

- **Class**: `MrPunyapal\LaravelExtendedValidation\Rules\Slug`
- **Macro**: `Rule::slug(?string $separator = '-')`
- **String**: `slug` or `slug:{separator}`
- **Rejected in**: [laravel/framework#38706](https://github.com/laravel/framework/pull/38706) and [#32353](https://github.com/laravel/framework/pull/32353)
- **Why rejected**: Maintainers prefer developers use custom regex or existing `alpha_dash` rules.

### Usage

```php
use MrPunyapal\LaravelExtendedValidation\Rules\Slug;
use Illuminate\Validation\Rule;

// Standard dash separator
'slug' => ['required', new Slug]
'slug' => ['required', Rule::slug()]
'slug' => 'required|slug'

// Custom underscore separator
'slug' => ['required', new Slug('_')]
'slug' => ['required', Rule::slug('_')]
'slug' => 'required|slug:_'
```

### Passes / Fails (with default `-`)

- Passes: `my-awesome-post`, `post-123`, `introduction`
- Fails: `My-Awesome-Post`, `my awesome post`, `my--post`, `-my-post`, `my-post-`, `my_post`

---

## even

Validates that a numeric input represents an even integer.

- **Class**: `MrPunyapal\LaravelExtendedValidation\Rules\EvenNumber`
- **Macro**: `Rule::even()`
- **String**: `even`
- **Rejected in**: [laravel/framework#43632](https://github.com/laravel/framework/pull/43632)
- **Why rejected**: Modulo checks are considered too simple to warrant framework core rules.

### Usage

```php
use MrPunyapal\LaravelExtendedValidation\Rules\EvenNumber;
use Illuminate\Validation\Rule;

'team_size' => ['required', 'integer', new EvenNumber]
'team_size' => ['required', 'integer', Rule::even()]
'team_size' => 'required|integer|even'
```

### Passes / Fails

- Passes: `0`, `2`, `4`, `-2`, `100`, `'42'`
- Fails: `1`, `3`, `-1`, `99`, `'7'`, `'abc'`

---

## odd

Validates that a numeric input represents an odd integer.

- **Class**: `MrPunyapal\LaravelExtendedValidation\Rules\OddNumber`
- **Macro**: `Rule::odd()`
- **String**: `odd`
- **Rejected in**: [laravel/framework#45781](https://github.com/laravel/framework/pull/45781)

### Usage

```php
use MrPunyapal\LaravelExtendedValidation\Rules\OddNumber;
use Illuminate\Validation\Rule;

'step' => ['required', 'integer', new OddNumber]
'step' => ['required', 'integer', Rule::odd()]
'step' => 'required|integer|odd'
```

### Passes / Fails

- Passes: `1`, `3`, `-1`, `99`, `'7'`
- Fails: `0`, `2`, `4`, `-2`, `100`, `'42'`, `'abc'`

---

## semver

Validates strings against the official [Semantic Versioning 2.0.0](https://semver.org) specification, including optional pre-release labels and build metadata.

- **Class**: `MrPunyapal\LaravelExtendedValidation\Rules\Semver`
- **Macro**: `Rule::semver()`
- **String**: `semver`
- **Rejected in**: [laravel/framework#36854](https://github.com/laravel/framework/pull/36854) and [#42921](https://github.com/laravel/framework/pull/42921)
- **Why rejected**: Considered too specialized for core framework needs.

### Usage

```php
use MrPunyapal\LaravelExtendedValidation\Rules\Semver;
use Illuminate\Validation\Rule;

'version' => ['required', new Semver]
'version' => ['required', Rule::semver()]
'version' => 'required|semver'
```

### Passes / Fails

- Passes: `1.0.0`, `0.1.0`, `1.2.3-alpha.1`, `2.0.0-beta+build.123`, `1.0.0-x.7.z.92`
- Fails: `v1.0.0` (prefix not allowed in SemVer 2.0), `1.0`, `1`, `01.0.0`, `1.0.0.0`

---

## base64_string

Validates that an attribute is valid base64-encoded data, with optional MIME type restrictions for data URI schemes.

- **Class**: `MrPunyapal\LaravelExtendedValidation\Rules\Base64String`
- **Macro**: `Rule::base64String(array|string $allowedMimeTypes = [])`
- **String**: `base64_string` or `base64_string:image/png,image/jpeg`
- **Rejected in**: [laravel/framework#41528](https://github.com/laravel/framework/pull/41528) and [#30744](https://github.com/laravel/framework/pull/30744)
- **Why rejected**: Memory/DoS concerns when decoding unbounded payloads during validation.

### Usage

```php
use MrPunyapal\LaravelExtendedValidation\Rules\Base64String;
use Illuminate\Validation\Rule;

// Any valid base64 payload
'payload' => ['required', new Base64String]

// Data URI restricted to images
'avatar' => ['required', new Base64String(['image/png', 'image/jpeg'])]
'avatar' => ['required', Rule::base64String('image/png', 'image/jpeg')]
'avatar' => 'required|base64_string:image/png,image/jpeg'
```

---

## luhn

Validates numeric strings against the Luhn algorithm (MOD-10 checksum), commonly used for credit cards, debit cards, IMEI numbers, and national identification numbers.

- **Class**: `MrPunyapal\LaravelExtendedValidation\Rules\Luhn`
- **Macro**: `Rule::luhn()`
- **String**: `luhn`
- **Rejected in**: [laravel/framework#31422](https://github.com/laravel/framework/pull/31422) and [#44805](https://github.com/laravel/framework/pull/44805)
- **Why rejected**: PCI-DSS guidance discourages handling raw credit card numbers on application servers.

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
- **Rejected in**: [laravel/framework#35108](https://github.com/laravel/framework/pull/35108)

### Usage

```php
use MrPunyapal\LaravelExtendedValidation\Rules\MinWords;
use Illuminate\Validation\Rule;

'article' => ['required', 'string', new MinWords(100)]
'article' => ['required', 'string', Rule::minWords(100)]
'article' => 'required|string|min_words:100'
```

---

## max_words

Validates that a string does not exceed a specified number of words.

- **Class**: `MrPunyapal\LaravelExtendedValidation\Rules\MaxWords`
- **Macro**: `Rule::maxWords(int $max)`
- **String**: `max_words:{max}`
- **Rejected in**: [laravel/framework#46092](https://github.com/laravel/framework/pull/46092)

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

Validates that a string is a valid domain name (FQDN) without requiring URL protocols (`http://` or `https://`).

- **Class**: `MrPunyapal\LaravelExtendedValidation\Rules\Domain`
- **Macro**: `Rule::domain()`
- **String**: `domain`
- **Rejected in**: [laravel/framework#38954](https://github.com/laravel/framework/pull/38954) and [#45470](https://github.com/laravel/framework/pull/45470)

### Usage

```php
use MrPunyapal\LaravelExtendedValidation\Rules\Domain;
use Illuminate\Validation\Rule;

'website' => ['required', new Domain]
'website' => ['required', Rule::domain()]
'website' => 'required|domain'
```

### Passes / Fails

- Passes: `example.com`, `sub.example.co.uk`, `my-portal.org`
- Fails: `https://example.com`, `192.168.1.1`, `localhost`, `-domain.com`

---

## e164

Validates international phone numbers according to the ITU-T E.164 recommendation (`+` sign followed by 2 to 15 digits).

- **Class**: `MrPunyapal\LaravelExtendedValidation\Rules\E164Phone`
- **Macro**: `Rule::e164()`
- **String**: `e164`
- **Rejected in**: [laravel/framework#48332](https://github.com/laravel/framework/pull/48332)

### Usage

```php
use MrPunyapal\LaravelExtendedValidation\Rules\E164Phone;
use Illuminate\Validation\Rule;

'phone' => ['required', new E164Phone]
'phone' => ['required', Rule::e164()]
'phone' => 'required|e164'
```

### Passes / Fails

- Passes: `+14155552671`, `+442071234567`, `+919876543210`
- Fails: `14155552671` (missing `+`), `+0123456789` (starts with `0`), `+1` (too short)

---

## isbn

Validates International Standard Book Numbers (ISBN-10, ISBN-13, or both) with full mathematical checksum verification.

- **Class**: `MrPunyapal\LaravelExtendedValidation\Rules\Isbn`
- **Macro**: `Rule::isbn(?string $type = null)`
- **String**: `isbn`, `isbn:10`, `isbn:13`
- **Rejected in**: [laravel/framework#37652](https://github.com/laravel/framework/pull/37652) and [#44299](https://github.com/laravel/framework/pull/44299)

### Usage

```php
use MrPunyapal\LaravelExtendedValidation\Rules\Isbn;
use Illuminate\Validation\Rule;

// Accepts both ISBN-10 and ISBN-13
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

Validates ISO 3166-1 country codes (alpha-2 or alpha-3).

- **Class**: `MrPunyapal\LaravelExtendedValidation\Rules\CountryCode`
- **Macro**: `Rule::countryCode(string $format = 'alpha2')`
- **String**: `country_code` or `country_code:alpha3`
- **Rejected in**: [laravel/framework#42110](https://github.com/laravel/framework/pull/42110) and [#47115](https://github.com/laravel/framework/pull/47115)

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

Validates CSS hex color codes (supporting 3, 4, 6, and 8 hex digits preceded by `#`).

- **Class**: `MrPunyapal\LaravelExtendedValidation\Rules\HexColor`
- **Macro**: `Rule::hexColor()`
- **String**: `hex_color`

### Usage

```php
use MrPunyapal\LaravelExtendedValidation\Rules\HexColor;
use Illuminate\Validation\Rule;

'accent_color' => ['required', new HexColor]
'accent_color' => ['required', Rule::hexColor()]
'accent_color' => 'required|hex_color'
```

### Passes / Fails

- Passes: `#fff`, `#FFF`, `#ffffff`, `#FFFFFF`, `#ffff`, `#ffffffff`
- Fails: `fff` (missing `#`), `#ff`, `#fffff`, `#gggggg`, `red`
