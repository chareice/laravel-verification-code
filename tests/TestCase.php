<?php
namespace Tests;

use Chareice\VerificationCode\ServiceProvider;
use Chareice\VerificationCode\VerificationCodeService;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app): array
    {
        return [ServiceProvider::class];
    }
}