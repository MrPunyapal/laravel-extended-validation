---
title: Acknowledgements
description: Community contributors and rejected Laravel pull requests that inspired rules in this package.
---

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

## Submitting a rule

If you know of another rejected validation rule from `laravel/framework` that fits this package:

1. Check that the rule can be implemented without adding third-party dependencies.
2. Open an issue or pull request on [GitHub](https://github.com/mrpunyapal/laravel-extended-validation).
3. Include a link to the original `laravel/framework` pull request or discussion.

