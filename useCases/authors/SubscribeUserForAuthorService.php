<?php

namespace app\useCases\authors;

use app\exceptions\FailedCreateSubscriberException;
use app\models\Author;
use app\repositories\AuthorRepository;

readonly class SubscribeUserForAuthorService
{
    public function __construct(private AuthorRepository $authorRepository)
    {
    }

    /**
     * @throws FailedCreateSubscriberException
     */
    public function subscribeByPhone(Author $author, string $phone): void
    {
        $this->authorRepository->subscribeUserByPhone($author->id, $phone);
    }
}