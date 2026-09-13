<?php

declare(strict_types=1);
use Illuminate\Contracts\Validation\ValidationRule;
use MrPunyapal\LaravelExtendedValidation\LaravelExtendedValidationServiceProvider;
use Spatie\LaravelPackageTools\PackageServiceProvider;

arch('it will not use debugging functions')
    ->expect(['dd', 'dump', 'ray', 'var_dump', 'print_r'])
    ->each->not->toBeUsed();

arch('all rules implement ValidationRule')
    ->expect('MrPunyapal\LaravelExtendedValidation\Rules')
    ->toImplement(ValidationRule::class);

arch('all rules are final')
    ->expect('MrPunyapal\LaravelExtendedValidation\Rules')
    ->toBeFinal();

arch('all rules use strict types')
    ->expect('MrPunyapal\LaravelExtendedValidation\Rules')
    ->toUseStrictTypes();

arch('service provider extends PackageServiceProvider')
    ->expect(LaravelExtendedValidationServiceProvider::class)
    ->toExtend(PackageServiceProvider::class);
