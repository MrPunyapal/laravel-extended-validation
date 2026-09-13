<?php

declare(strict_types=1);

namespace MrPunyapal\LaravelExtendedValidation;

use Illuminate\Contracts\Translation\Translator;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Translation\PotentiallyTranslatedString;
use Illuminate\Validation\Rule;
use MrPunyapal\LaravelExtendedValidation\Rules\AlphaNumAscii;
use MrPunyapal\LaravelExtendedValidation\Rules\AlphaUnderscore;
use MrPunyapal\LaravelExtendedValidation\Rules\Base64String;
use MrPunyapal\LaravelExtendedValidation\Rules\Cidr;
use MrPunyapal\LaravelExtendedValidation\Rules\CountryCode;
use MrPunyapal\LaravelExtendedValidation\Rules\Domain;
use MrPunyapal\LaravelExtendedValidation\Rules\E164Phone;
use MrPunyapal\LaravelExtendedValidation\Rules\EmailDomain;
use MrPunyapal\LaravelExtendedValidation\Rules\EvenNumber;
use MrPunyapal\LaravelExtendedValidation\Rules\HexColor;
use MrPunyapal\LaravelExtendedValidation\Rules\Isbn;
use MrPunyapal\LaravelExtendedValidation\Rules\Latitude;
use MrPunyapal\LaravelExtendedValidation\Rules\Longitude;
use MrPunyapal\LaravelExtendedValidation\Rules\Luhn;
use MrPunyapal\LaravelExtendedValidation\Rules\MaxWords;
use MrPunyapal\LaravelExtendedValidation\Rules\MinWords;
use MrPunyapal\LaravelExtendedValidation\Rules\MultipleOf;
use MrPunyapal\LaravelExtendedValidation\Rules\NoHtml;
use MrPunyapal\LaravelExtendedValidation\Rules\NotEmail;
use MrPunyapal\LaravelExtendedValidation\Rules\NotHashed;
use MrPunyapal\LaravelExtendedValidation\Rules\OddNumber;
use MrPunyapal\LaravelExtendedValidation\Rules\Semver;
use MrPunyapal\LaravelExtendedValidation\Rules\Slug;
use MrPunyapal\LaravelExtendedValidation\Rules\SnakeCase;
use MrPunyapal\LaravelExtendedValidation\Rules\UnlessBetween;
use MrPunyapal\LaravelExtendedValidation\Rules\UrlProtocol;
use MrPunyapal\LaravelExtendedValidation\Rules\WithoutAlias;
use MrPunyapal\LaravelExtendedValidation\Rules\WithoutWhitespace;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelExtendedValidationServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-extended-validation')
            ->hasConfigFile('extended-validation')
            ->hasTranslations();
    }

    public function packageBooted(): void
    {
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'laravel-extended-validation');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'extended-validation');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/extended-validation.php' => config_path('extended-validation.php'),
            ], 'laravel-extended-validation-config');
        }

        $this->registerRules();
    }

    protected function registerRules(): void
    {
        /** @var array<string, class-string<ValidationRule>> $rules */
        $rules = [
            'slug' => Slug::class,
            'even' => EvenNumber::class,
            'odd' => OddNumber::class,
            'semver' => Semver::class,
            'base64_string' => Base64String::class,
            'luhn' => Luhn::class,
            'min_words' => MinWords::class,
            'max_words' => MaxWords::class,
            'domain' => Domain::class,
            'e164' => E164Phone::class,
            'isbn' => Isbn::class,
            'country_code' => CountryCode::class,
            'hex_color' => HexColor::class,
            'without_alias' => WithoutAlias::class,
            'not_email' => NotEmail::class,
            'latitude' => Latitude::class,
            'longitude' => Longitude::class,
            'cidr' => Cidr::class,
            'email_domain' => EmailDomain::class,
            'not_hashed' => NotHashed::class,
            'alpha_underscore' => AlphaUnderscore::class,
            'unless_between' => UnlessBetween::class,
            'without_whitespace' => WithoutWhitespace::class,
            'no_html' => NoHtml::class,
            'url_protocol' => UrlProtocol::class,
            'snake_case' => SnakeCase::class,
            'multiple_of' => MultipleOf::class,
            'alpha_num_ascii' => AlphaNumAscii::class,
        ];

        foreach ($rules as $name => $ruleClass) {
            $this->registerStringRule($name, $ruleClass);
            $this->registerRuleMacro($name, $ruleClass);
        }
    }

    /**
     * @param  class-string<ValidationRule>  $ruleClass
     */
    protected function registerStringRule(string $name, string $ruleClass): void
    {
        Validator::extend($name, function (string $attribute, mixed $value, array $parameters) use ($ruleClass): bool {
            /** @var ValidationRule $rule */
            $rule = new $ruleClass(...$parameters);
            $failed = false;

            $rule->validate($attribute, $value, function (string $message = '') use (&$failed): PotentiallyTranslatedString {
                $failed = true;

                /** @var Translator $translator */
                $translator = app('translator');

                return new PotentiallyTranslatedString($message, $translator);
            });

            return ! $failed;
        });

        Validator::replacer($name, function (string $message, string $attribute, string $rule, array $parameters) use ($name): string {
            $replacements = $this->getRuleReplacements($name, $parameters, $attribute);

            $isDefaultMessage = $message === "validation.{$name}"
                || str_ends_with($message, ".{$name}")
                || $message === trans("validation.{$name}")
                || $message === trans("validation.{$name}", ['attribute' => $attribute]);

            if ($isDefaultMessage) {
                /** @var string */
                $translation = trans("extended-validation::validation.{$name}", $replacements);
                if ($translation === "extended-validation::validation.{$name}") {
                    $translation = trans("laravel-extended-validation::validation.{$name}", $replacements);
                }

                return $translation;
            }

            foreach ($replacements as $key => $value) {
                $message = str_replace(
                    [':'.$key, ':'.Str::upper($key), ':'.Str::ucfirst($key)],
                    [$value, Str::upper((string) $value), Str::ucfirst((string) $value)],
                    $message
                );
            }

            return $message;
        });
    }

    /**
     * @param  array<int, string>  $parameters
     * @return array<string, string>
     */
    protected function getRuleReplacements(string $name, array $parameters, string $attribute): array
    {
        $replacements = ['attribute' => $attribute];

        switch ($name) {
            case 'min_words':
                $replacements['min'] = $parameters[0] ?? '';
                break;
            case 'max_words':
                $replacements['max'] = $parameters[0] ?? '';
                break;
            case 'multiple_of':
                $replacements['step'] = $parameters[0] ?? '';
                $replacements['value'] = $parameters[0] ?? '';
                break;
            case 'unless_between':
                $val1 = $parameters[0] ?? '';
                $val2 = $parameters[1] ?? '';
                if (is_numeric($val1) && is_numeric($val2)) {
                    $min = min((float) $val1, (float) $val2);
                    $max = max((float) $val1, (float) $val2);
                    $replacements['min'] = (string) (str_contains((string) $val1, '.') || str_contains((string) $val2, '.') ? $min : (int) $min);
                    $replacements['max'] = (string) (str_contains((string) $val1, '.') || str_contains((string) $val2, '.') ? $max : (int) $max);
                } else {
                    $replacements['min'] = (string) $val1;
                    $replacements['max'] = (string) $val2;
                }
                break;
            case 'url_protocol':
                $replacements['protocols'] = implode(', ', array_map(
                    fn (string $p): string => rtrim(strtolower(trim($p)), ':/'),
                    $parameters
                ));
                break;
        }

        return $replacements;
    }

    /**
     * @param  class-string<ValidationRule>  $ruleClass
     */
    protected function registerRuleMacro(string $name, string $ruleClass): void
    {
        $methodName = Str::camel($name);

        Rule::macro($methodName, fn (mixed ...$args) => new $ruleClass(...$args));
    }
}
