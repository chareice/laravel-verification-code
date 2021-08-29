<?php


namespace Tests;


use Chareice\VerificationCode\Events\VerificationCodeCreatedEvent;
use Chareice\VerificationCode\VerificationCodeService;
use Illuminate\Support\Facades\Event;

class FeatureTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Event::fake();
    }

    public function testCreateCode() {
        $key = '13877776666';

        /** @var VerificationCodeService $codeService */
        $codeService = $this->app->make(VerificationCodeService::class);
        $this->assertFalse($codeService->check($key,'123'));
        $this->assertFalse($codeService->check('123', '123'));
        $code = $codeService->setCode($key, 30);

        Event::assertDispatched(VerificationCodeCreatedEvent::class, function($event, $payload) use ($key, $code) {
            return $key === $payload['key'] && $code === $payload['code'];
        });

        $this->assertFalse($codeService->check($key, '123'));
        $this->assertTrue($codeService->check($key, $code));

    }
}