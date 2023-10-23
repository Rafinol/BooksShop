<?php

namespace app\useCases\senders;

interface Sender
{
    public function send(string|array $recipient, string $message): void;
}
