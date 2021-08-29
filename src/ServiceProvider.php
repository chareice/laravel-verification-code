<?php
namespace Chareice\VerificationCode;

use Illuminate\Contracts\Support\DeferrableProvider;

class ServiceProvider extends \Illuminate\Support\ServiceProvider implements DeferrableProvider
{
    public function register()
    {
        $this->app->singleton(VerificationCodeService::class, function() {
            return new VerificationCodeService();
        });
    }

    public function provides()
    {
        return [VerificationCodeService::class];
    }
}