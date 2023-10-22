<?php

namespace app\listeners;

use app\events\AfterBookCreated;
use app\useCases\books\SendNewBookAvailableNotificationService;

readonly class AfterBookCreatedListener
{
    public function __construct(private SendNewBookAvailableNotificationService $notificationService)
    {
    }

    public function handle(AfterBookCreated $event): void
    {
        $book = $event->getBook();

        $this->notificationService->run($book);
    }
}