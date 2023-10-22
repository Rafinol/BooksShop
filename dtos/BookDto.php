<?php

namespace app\dtos;

use DateTime;

class BookDto
{
    private string   $name;
    private DateTime $released_at;
    private string   $description;
    private string   $isbn;
    private array    $photos;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getReleasedAt(): DateTime
    {
        return $this->released_at;
    }

    public function setReleasedAt(DateTime $released_at): self
    {
        $this->released_at = $released_at;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getIsbn(): string
    {
        return $this->isbn;
    }

    public function setIsbn(string $isbn): self
    {
        $this->isbn = $isbn;

        return $this;
    }

    public function getPhotos(): array
    {
        return $this->photos;
    }

    public function setPhotos(array $photos): self
    {
        $this->photos = $photos;

        return $this;
    }

}