---
title: Configuration
description: Configure and selectively enable or disable validation rules in mrpunyapal/laravel-extended-validation.
---

# Configuration

You can selectively enable or disable individual validation rules to suit your application and avoid naming collisions with other packages.

## Publish the config file

Run the Artisan publish command:

```bash
php artisan vendor:publish --tag="laravel-extended-validation-config"
```

## Configuration options

The published file lives at `config/laravel-extended-validation.php`:

```php
return [

    /*
    |--------------------------------------------------------------------------
    | Enabled Rules
    |--------------------------------------------------------------------------
    |
    | You may disable specific validation rules by setting them to false.
    | All rules are enabled by default.
    |
    */

    'rules' => [
        'slug' => true,
        'even' => true,
        'odd' => true,
        'semver' => true,
        'base64_string' => true,
        'luhn' => true,
        'min_words' => true,
        'max_words' => true,
        'domain' => true,
        'e164' => true,
        'isbn' => true,
        'country_code' => true,
        'hex_color' => true,
        'without_alias' => true,
        'not_email' => true,
    ],

];
```

To disable any rule, set its value to `false`. Disabled rules are not registered on `Validator` or as macros on `Rule`.

## Next steps

- Read [Usage](usage.md) to see how to apply rules in form requests and controllers.
- Check the [Rules reference](rules.md) for individual rule behavior.
