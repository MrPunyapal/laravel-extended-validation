<?php

declare(strict_types=1);

namespace MrPunyapal\LaravelExtendedValidation\Tests;

use MrPunyapal\LaravelExtendedValidation\LaravelExtendedValidationServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            LaravelExtendedValidationServiceProvider::class,
        ];
    }
}
