<?php

declare(strict_types=1);

// config for MrPunyapal/LaravelExtendedValidation

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
