# Installation

## Requirements

- PHP `^8.3`, `^8.4`, or `^8.5`
- Laravel 11, 12, or 13

## Install the package

Install the package via Composer:

```bash
composer require mrpunyapal/laravel-extended-validation
```

## Package Auto-Discovery

The package automatically registers its service provider (`MrPunyapal\LaravelExtendedValidation\LaravelExtendedValidationServiceProvider`) through Laravel's package auto-discovery. No manual provider registration in `bootstrap/providers.php` or `config/app.php` is necessary.

## Publishing Configuration

Optionally publish the package configuration file:

```bash
php artisan vendor:publish --tag="laravel-extended-validation-config"
```

This will create `config/laravel-extended-validation.php` in your application. See [Configuration](configuration/) for details.

## Publishing Translations

All validation error messages can be published and customized:

```bash
php artisan vendor:publish --tag="laravel-extended-validation-translations"
```

This places the translation files in `lang/vendor/laravel-extended-validation` where you can translate them into any language or tweak the error messages.

## Laravel Boost

The package ships a Laravel Boost skill named `laravel-extended-validation-development` for on-demand AI guidance when using these extended validation rules.

If your Laravel application uses Boost, install Boost and publish its resources:

```bash
composer require laravel/boost --dev
php artisan boost:install
```

If Boost is already installed and you add this package later, discover the new package skills:

```bash
php artisan boost:update --discover
```

## Next steps

- Explore [Configuration](configuration/) to enable or disable specific rules.
- Read [Usage](usage/) to see how to use rules in Form Requests and Validators.
- Check the [Rules](rules/) reference for complete examples of all 15 rules.
