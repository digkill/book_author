<?php

namespace app\services\SmsSender;

interface SmsServiceInterface
{
    public function send(string $phone, string $message, string $sender): bool;
}