<?php

declare(strict_types=1);

return [
    'slug' => 'The :attribute must be a valid URL-friendly slug.',
    'even' => 'The :attribute must be an even number.',
    'odd' => 'The :attribute must be an odd number.',
    'semver' => 'The :attribute must be a valid semantic version (e.g. 1.0.0).',
    'base64_string' => 'The :attribute must be a valid base64 encoded string.',
    'luhn' => 'The :attribute must pass the Luhn checksum validation.',
    'min_words' => 'The :attribute must have at least :min words.',
    'max_words' => 'The :attribute must not exceed :max words.',
    'domain' => 'The :attribute must be a valid domain name.',
    'e164' => 'The :attribute must be a valid E.164 phone number (e.g. +14155552671).',
    'isbn' => 'The :attribute must be a valid ISBN.',
    'country_code' => 'The :attribute must be a valid ISO 3166-1 country code.',
    'hex_color' => 'The :attribute must be a valid hex color code.',
    'without_alias' => 'The :attribute must not contain a plus-alias (e.g. user+tag@example.com).',
    'not_email' => 'The :attribute must not be an email address.',
    'latitude' => 'The :attribute must be a valid latitude between -90 and 90 degrees.',
    'longitude' => 'The :attribute must be a valid longitude between -180 and 180 degrees.',
    'cidr' => 'The :attribute must be a valid CIDR notation block.',
    'email_domain' => 'The :attribute must be an email address from an authorized domain.',
    'not_hashed' => 'The :attribute must not be a pre-hashed string.',
    'alpha_underscore' => 'The :attribute may only contain letters, numbers, and underscores.',
    'unless_between' => 'The :attribute must not be between :min and :max.',
];
