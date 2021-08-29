<?php


namespace Tests;


use Chareice\VerificationCode\VerificationCodeService;

class FeatureTest extends TestCase
{
    public function testCreateCode() {
        $key = '13877776666';

        /** @var VerificationCodeService $codeService */
        $codeService = $this->app->make(VerificationCodeService::class);
        $this->assertFalse($codeService->check($key,'123'));
        $this->assertFalse($codeService->check('123', '123'));
        $code = $codeService->setCode($key, 30);

        $this->assertFalse($codeService->check($key, '123'));
        $this->assertTrue($codeService->check($key, $code));
    }
}