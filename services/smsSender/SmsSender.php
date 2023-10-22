<?php

namespace app\services\smsSender;

interface SmsSender
{
    public function send(string|array $to, string $message): void;
}