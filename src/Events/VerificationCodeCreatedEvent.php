<?php
namespace Chareice\VerificationCode\Events;

use Illuminate\Foundation\Events\Dispatchable;

class VerificationCodeCreatedEvent
{
    use Dispatchable;

    public function __construct(public string $key, public string $code, public int $seconds)
    {

    }
}