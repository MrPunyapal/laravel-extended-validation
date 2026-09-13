---
title: Usage
description: Learn the three syntax options for applying extended validation rules in Laravel applications.
---

# Usage

Every rule in this package supports three usage patterns: class instances, fluent macros on the `Rule` facade, and pipe-delimited string rules.

## 1. Class instance syntax (Recommended)

Instantiate rule objects directly or call their static `make()` method. This provides full IDE auto-completion and static analysis:

```php
use MrPunyapal\LaravelExtendedValidation\Rules\WithoutAlias;
use MrPunyapal\LaravelExtendedValidation\Rules\NotEmail;
use MrPunyapal\LaravelExtendedValidation\Rules\Slug;

$request->validate([
    'email'    => ['required', 'email', new WithoutAlias],
    'username' => ['required', 'string', new NotEmail],
    'slug'     => ['required', Slug::make()],
]);
```

Pass constructor parameters to customize rule behavior:

```php
use MrPunyapal\LaravelExtendedValidation\Rules\Slug;
use MrPunyapal\LaravelExtendedValidation\Rules\MinWords;
use MrPunyapal\LaravelExtendedValidation\Rules\Base64String;

$request->validate([
    'slug'   => ['required', new Slug('_')],
    'bio'    => ['required', new MinWords(50)],
    'avatar' => ['required', new Base64String('image/png', 'image/jpeg')],
]);
```

## 2. Fluent Rule macro syntax

The package registers camelCase macros on Laravel's `Illuminate\Validation\Rule` class:

```php
use Illuminate\Validation\Rule;

$request->validate([
    'email'    => ['required', 'email', Rule::withoutAlias()],
    'username' => ['required', 'string', Rule::notEmail()],
    'slug'     => ['required', Rule::slug()],
    'phone'    => ['required', Rule::e164()],
    'bio'      => ['required', Rule::minWords(20)],
    'country'  => ['required', Rule::countryCode('alpha3')],
]);
```

## 3. String syntax

Use standard string rules for concise validation arrays or form request definitions:

```php
$request->validate([
    'email'    => 'required|email|without_alias',
    'username' => 'required|string|not_email',
    'slug'     => 'required|slug',
    'phone'    => 'required|e164',
    'version'  => 'required|semver',
    'color'    => 'required|hex_color',
]);
```

Rules with parameters accept them via colon separation:

```php
$request->validate([
    'slug'    => 'required|slug:_',
    'country' => 'required|country_code:alpha3',
    'isbn'    => 'required|isbn:13',
    'bio'     => 'required|min_words:25',
]);
```

## Customizing error messages

### Inline messages

Override messages directly when calling `$request->validate()` or inside a form request `messages()` method:

```php
$request->validate([
    'email' => ['required', 'email', Rule::withoutAlias()],
], [
    'email.without_alias' => 'Please provide a direct email address without aliases.',
]);
```

### Translation files

Publish the package translations to customize messages application-wide:

```bash
php artisan vendor:publish --tag="laravel-extended-validation-translations"
```

Edit `lang/vendor/laravel-extended-validation/en/validation.php`:

```php
return [
    'without_alias' => 'The :attribute must not contain a plus-alias.',
    'not_email'     => 'The :attribute cannot be an email address.',
    // ...
];
```

## Next steps

- Explore all 15 rules with input examples in the [Rules reference](rules.md).
