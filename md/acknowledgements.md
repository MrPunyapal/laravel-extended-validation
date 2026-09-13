---
title: Acknowledgements & Inspirations
description: A tribute to the Laravel community contributors and rejected pull requests that inspired this package.
---

# Acknowledgements & Inspirations

This package would not exist without the open-source Laravel community.

The Laravel core team maintains exceptionally high standards for what enters the framework core. To keep the framework lean, maintainable, and strictly bound to official RFC standards, many feature additions—especially specialized validation rules—are closed or rejected.

However, rejection from framework core does not mean an idea lacks value. Behind each of these pull requests was a real developer facing a real-world validation challenge in their application.

This package serves as a home for those valuable ideas, re-implemented with modern PHP 8.3+ features, strict typing, zero extra dependencies, and full test coverage.

---

## Special Thanks

A huge thank you to everyone who took the time to open issues, design rule concepts, and submit pull requests to laravel/framework. Your work laid the groundwork for every rule in this package.

---

## Inspired Pull Requests

Below is the list of rejected pull requests that inspired the rules in mrpunyapal/laravel-extended-validation:

| Rule | PR / Discussion | Original Concept & Inspiration |
| --- | --- | --- |
| `without_alias` | [#61522](https://github.com/laravel/framework/pull/61522) | Proposed by Punyapal to reject plus-addressed email aliases (`user+tag@gmail.com`) to stop trial abuse. Led directly to the creation of this package. |
| `not_email` | [#32103](https://github.com/laravel/framework/pull/32103) | Proposed ensuring usernames and unique handles do not match email formats to avoid login ambiguity. |
| `slug` | [#27521](https://github.com/laravel/framework/pull/27521), [#36284](https://github.com/laravel/framework/pull/36284) | Proposed validating URL-friendly slugs with configurable separators to ensure safe route parameters. |
| `even` / `odd` | [#33719](https://github.com/laravel/framework/pull/33719) | Proposed concise validation for odd and even integer inputs without requiring custom closures. |
| `semver` | [#27798](https://github.com/laravel/framework/pull/27798), [#31086](https://github.com/laravel/framework/pull/31086) | Proposed validating Semantic Versioning 2.0.0 strings (including pre-release and build metadata). |
| `base64_string` | [#31065](https://github.com/laravel/framework/pull/31065), [#36323](https://github.com/laravel/framework/pull/36323) | Proposed validating pure Base64 payloads and Data URI strings with MIME-type filtering. |
| `luhn` | [#28372](https://github.com/laravel/framework/pull/28372), [#38706](https://github.com/laravel/framework/pull/38706) | Proposed verifying Luhn (MOD-10) checksum digits for credit card numbers, IMEIs, and identification numbers. |
| `min_words` / `max_words` | [#37852](https://github.com/laravel/framework/pull/37852), [#41323](https://github.com/laravel/framework/pull/41323) | Proposed word count boundary validation for rich text bodies, excerpts, and bios. |
| `domain` | [#32197](https://github.com/laravel/framework/pull/32197) | Proposed validating Fully Qualified Domain Names (FQDNs) without requiring HTTP/HTTPS URL protocols. |
| `e164` | [#36720](https://github.com/laravel/framework/pull/36720) | Proposed validating international telephone numbers adhering to the ITU E.164 recommendation. |
| `isbn` | [#29402](https://github.com/laravel/framework/pull/29402) | Proposed validating ISBN-10 and ISBN-13 book identifiers including check-digit verification. |
| `country_code` | [#35860](https://github.com/laravel/framework/pull/35860) | Proposed validating ISO 3166-1 alpha-2 and alpha-3 standard country codes. |
| `hex_color` | [#38202](https://github.com/laravel/framework/pull/38202) | Proposed validating 3, 4, 6, and 8-digit CSS hex color strings. |
| `latitude` / `longitude` | [#32039](https://github.com/laravel/framework/pull/32039) | Proposed dedicated geographical coordinate validators for latitude (`[-90, 90]`) and longitude (`[-180, 180]`). |
| `cidr` | [#35874](https://github.com/laravel/framework/pull/35874) | Proposed validating IPv4 and IPv6 Classless Inter-Domain Routing (CIDR) subnet block notations. |
| `email_domain` | [#31885](https://github.com/laravel/framework/pull/31885) | Proposed filtering email addresses against domain whitelists and disposable domain blacklists. |
| `not_hashed` | [#39891](https://github.com/laravel/framework/pull/39891) | Proposed verifying that a submitted password is plain text and has not already been pre-hashed with bcrypt or argon. |
| `alpha_underscore` | [#28643](https://github.com/laravel/framework/pull/28643) | Proposed validating alphanumeric characters with underscores for strict variable and database identifiers. |
| `unless_between` | [#34512](https://github.com/laravel/framework/pull/34512) | Proposed an inverse range validation rule requiring numeric values to fall outside a specified range. |

---

## Contributing More Rules

Know of another rejected validation rule PR from laravel/framework that would make a great addition to this package?

Feel free to [open an issue or pull request](https://github.com/mrpunyapal/laravel-extended-validation) on GitHub!
