# Configuration

The package comes with an optional configuration file that lets you toggle individual rules on or off.

## Publishing the config

Publish `config/laravel-extended-validation.php`:

```bash
php artisan vendor:publish --tag="laravel-extended-validation-config"
```

## Configuration options

The configuration file contains an array of enabled rules:

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

By default, all rules are enabled. If you want to avoid collisions with any other package or custom rule, simply set the corresponding rule name to `false`.

## Next step

Learn about the three syntax options in [Usage](usage/).
