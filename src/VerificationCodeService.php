<?php
namespace Chareice\VerificationCode;

use Chareice\VerificationCode\Events\VerificationCodeCreatedEvent;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Event;

class VerificationCodeService {
    /**
     * 检查验证码是否正确
     * @param string $key
     * @param string $code
     * @return bool
     */
    public function check(string $key, string $code): bool
    {
        $cachedCode = Cache::get($key);

        if (!$cachedCode) {
            return false;
        }

        return $cachedCode == $code;
    }

    public function setCode(string $key, int $seconds): string
    {
        $code = $this->randomCode();
        Cache::add($key, $code, $seconds);

        Event::dispatch(VerificationCodeCreatedEvent::class, compact('key', 'code', 'seconds'));

        return $code;
    }

    private function randomCode(): string
    {
        $length = config('verification-code.length', 6);
        return random_int(111111, 999999);
    }
}