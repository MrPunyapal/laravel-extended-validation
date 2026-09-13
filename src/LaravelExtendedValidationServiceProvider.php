<?php

declare(strict_types=1);

namespace MrPunyapal\LaravelExtendedValidation;

use Illuminate\Contracts\Translation\Translator;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Translation\PotentiallyTranslatedString;
use Illuminate\Validation\Rule;
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
use MrPunyapal\LaravelExtendedValidation\Rules\NotEmail;
use MrPunyapal\LaravelExtendedValidation\Rules\NotHashed;
use MrPunyapal\LaravelExtendedValidation\Rules\OddNumber;
use MrPunyapal\LaravelExtendedValidation\Rules\Semver;
use MrPunyapal\LaravelExtendedValidation\Rules\Slug;
use MrPunyapal\LaravelExtendedValidation\Rules\UnlessBetween;
use MrPunyapal\LaravelExtendedValidation\Rules\WithoutAlias;
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
            /** @var string */
            $translation = trans("extended-validation::validation.{$name}", ['attribute' => $attribute]);
            if ($translation === "extended-validation::validation.{$name}") {
                $translation = trans("laravel-extended-validation::validation.{$name}", ['attribute' => $attribute]);
            }

            return $translation;
        });
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
