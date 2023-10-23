<?php

namespace app\useCases\books;

use app\dtos\BookDto;
use app\events\AfterBookCreated;
use app\exceptions\FailedCreateBookException;
use app\models\Book;
use app\repositories\BookRepository;
use Psr\EventDispatcher\EventDispatcherInterface;

readonly class CreateBookService
{
    public function __construct(
        private BookRepository $bookRepository,
        private EventDispatcherInterface $eventDispatcher
    ) {
    }

    /**
     * @throws FailedCreateBookException
     */
    public function addNewBook(BookDto $dto, array $authorsId): Book
    {
        $book = $this->bookRepository->create($dto, $authorsId);

        $this->eventDispatcher->dispatch(new AfterBookCreated($book));

        return $book;
    }
}
