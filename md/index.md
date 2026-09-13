# Laravel Extended Validation

A collection of **15 useful validation rules** that were proposed to Laravel framework core but closed or rejected — implemented following modern Laravel standards.

Every rule can be used in three ways: as a standalone validation class (`new Slug`), as a fluent `Rule::` macro (`Rule::slug()`), or as a standard string rule (`'slug'`).

## Available Rules

| Rule | Description | Syntax | Rejected In |
| --- | --- | --- | --- |
| [WithoutAlias](rules/#without_alias) | Reject plus-addressed email aliases (e.g. `user+tag@gmail.com`) | `without_alias` | [PR #61522](https://github.com/laravel/framework/pull/61522) |
| [NotEmail](rules/#not_email) | Ensure a value is not an email address (e.g. for usernames) | `not_email` | [PR #60915](https://github.com/laravel/framework/pull/60915) |
| [Slug](rules/#slug) | Validate URL-friendly slugs with configurable separator | `slug` / `slug:_` | [PR #38706](https://github.com/laravel/framework/pull/38706) |
| [EvenNumber](rules/#even) | Ensure numeric input is an even number | `even` | [PR #43632](https://github.com/laravel/framework/pull/43632) |
| [OddNumber](rules/#odd) | Ensure numeric input is an odd number | `odd` | [PR #45781](https://github.com/laravel/framework/pull/45781) |
| [Semver](rules/#semver) | Validate Semantic Versioning 2.0.0 strings | `semver` | [PR #36854](https://github.com/laravel/framework/pull/36854) |
| [Base64String](rules/#base64_string) | Validate base64 strings and data URIs with MIME checks | `base64_string` | [PR #41528](https://github.com/laravel/framework/pull/41528) |
| [Luhn](rules/#luhn) | Validate numeric strings against the Luhn/MOD-10 checksum | `luhn` | [PR #31422](https://github.com/laravel/framework/pull/31422) |
| [MinWords](rules/#min_words) | Validate minimum word count | `min_words:N` | [PR #35108](https://github.com/laravel/framework/pull/35108) |
| [MaxWords](rules/#max_words) | Validate maximum word count | `max_words:N` | [PR #46092](https://github.com/laravel/framework/pull/46092) |
| [Domain](rules/#domain) | Validate domain names without requiring `http://` or `https://` | `domain` | [PR #38954](https://github.com/laravel/framework/pull/38954) |
| [E164Phone](rules/#e164) | Validate international phone numbers in E.164 format | `e164` | [PR #48332](https://github.com/laravel/framework/pull/48332) |
| [Isbn](rules/#isbn) | Validate ISBN-10, ISBN-13, or both with checksums | `isbn` / `isbn:10` / `isbn:13` | [PR #37652](https://github.com/laravel/framework/pull/37652) |
| [CountryCode](rules/#country_code) | Validate ISO 3166-1 alpha-2 or alpha-3 country codes | `country_code` / `country_code:alpha3` | [PR #42110](https://github.com/laravel/framework/pull/42110) |
| [HexColor](rules/#hex_color) | Validate CSS hex color codes (3, 4, 6, or 8 characters) | `hex_color` | Community Rule |

## Why this package?

In `laravel/framework`, pull requests for new validation rules are frequently closed by core maintainers not because the rules lack utility, but because:

1. **Core Leanness**: The framework avoids single-regex wrapper rules to avoid bloat.
2. **RFC Strictness**: Some rules (such as sub-addressing in email) restrict inputs that are RFC-valid even though real-world apps need to block them to prevent abuse.
3. **Dataset Maintenance**: Rules requiring ISO codes, country lists, or postal formats require constant maintenance that core avoids taking on.

This package bridges that gap by packaging these requested validation rules into a single, clean, thoroughly tested package.

## Next steps

- [Installation](installation/) — requirements and setup.
- [Configuration](configuration/) — enable or disable specific rules.
- [Usage](usage/) — three flexible ways to use any rule.
- [Rules](rules/) — detailed documentation and examples for every rule.
