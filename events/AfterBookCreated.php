<?php

namespace app\events;

use app\models\Book;

readonly class AfterBookCreated
{
    public function __construct(private Book $book)
    {
    }

    public function getBook(): Book
    {
        return $this->book;
    }
}
