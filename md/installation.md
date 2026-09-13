---
title: Installation
description: Install and configure mrpunyapal/laravel-extended-validation in your Laravel application.
---

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

This creates `config/laravel-extended-validation.php`. See [Configuration](configuration.md) for available settings.

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
