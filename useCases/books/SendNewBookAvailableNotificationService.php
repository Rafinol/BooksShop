<?php

namespace app\useCases\books;

use app\models\Book;
use app\useCases\senders\Sender;
use yii\helpers\ArrayHelper;

readonly class SendNewBookAvailableNotificationService
{
    public function __construct(private Sender $sender)
    {
    }

    public function run(Book $book): void
    {
        $subscribers = $this->getSubscribers($book);
        $message = $this->getMessage($book);

        $this->sender->send($subscribers, $message);
    }

    private function getMessage(Book $book): string
    {
        return "В продаже новая книга от вашего любимого автора. " . $book->name . '.';
    }

    private function getSubscribers(Book $book): array
    {
        $authors = $book->authors;

        $subscribers = [];
        foreach ($authors as $author) {
            $subscribers[] = ArrayHelper::getColumn($author->getSubscribersPhones(), 'phone');
        }

        return array_unique(array_merge(...$subscribers));
    }
}