<?php

namespace app\useCases\authors;

use app\dtos\AuthorDto;
use app\exceptions\FailedCreateAuthorException;
use app\models\Author;
use app\repositories\AuthorRepository;

readonly class CreateAuthorsService
{
    public function __construct(private AuthorRepository $authorRepository)
    {
    }

    /**
     * @throws FailedCreateAuthorException
     */
    public function addNewAuthor(AuthorDto $authorDto): Author
    {
        return $this->authorRepository->create($authorDto);
    }
}
