# Usage

Laravel Extended Validation is designed to feel completely native to Laravel. Every rule supports three distinct consumption patterns.

## 1. Class Instance Syntax (Recommended)

Instantiate the rule directly or use its static `make()` method. This approach provides full IDE autocomplete, type safety, and static analysis support:

```php
use MrPunyapal\LaravelExtendedValidation\Rules\Slug;
use MrPunyapal\LaravelExtendedValidation\Rules\WithoutAlias;
use MrPunyapal\LaravelExtendedValidation\Rules\NotEmail;

$request->validate([
    'slug'     => ['required', 'string', new Slug],
    'email'    => ['required', 'email', new WithoutAlias],
    'username' => ['required', 'string', NotEmail::make()],
]);
```

You can pass arguments to the constructor or `make()` method:

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

## 2. Fluent Rule Macro Syntax

All rules are registered as macros on Laravel's built-in `Illuminate\Validation\Rule` class using camelCase naming:

```php
use Illuminate\Validation\Rule;

$request->validate([
    'slug'     => ['required', Rule::slug()],
    'email'    => ['required', 'email', Rule::withoutAlias()],
    'username' => ['required', Rule::notEmail()],
    'phone'    => ['required', Rule::e164()],
    'bio'      => ['required', Rule::minWords(20)],
    'country'  => ['required', Rule::countryCode()],
]);
```

## 3. Classic String Syntax

Rules are also registered with the validator so you can use pipe-delimited strings:

```php
$request->validate([
    'slug'     => 'required|slug',
    'email'    => 'required|email|without_alias',
    'username' => 'required|string|not_email',
    'phone'    => 'required|e164',
    'version'  => 'required|semver',
    'color'    => 'required|hex_color',
]);
```

Rules that accept arguments can take them via colon notation:

```php
$request->validate([
    'slug'    => 'required|slug:_',
    'country' => 'required|country_code:alpha3',
    'isbn'    => 'required|isbn:13',
]);
```

## Customizing Error Messages

### Inline Messages

You can override messages inline when validating:

```php
$request->validate([
    'email' => ['required', 'email', new WithoutAlias],
], [
    'email.without_alias' => 'We do not accept disposable or alias email addresses.',
]);
```

### Global Localization

Publish the package translations:

```bash
php artisan vendor:publish --tag="laravel-extended-validation-translations"
```

Then edit `lang/vendor/laravel-extended-validation/en/validation.php`.

## Next step

Read [Rules](rules/) for full details and examples of each rule.
