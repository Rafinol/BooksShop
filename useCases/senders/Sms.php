<?php

namespace app\useCases\senders;

use app\services\smsSender\SmsSender;

readonly class Sms implements Sender
{
    public function __construct(private SmsSender $sender)
    {
    }

    public function send(string|array $recipient, string $message): void
    {
        $this->sender->send($recipient, $message);
    }
}