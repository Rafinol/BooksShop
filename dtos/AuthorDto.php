<?php

namespace app\dtos;

class AuthorDto
{
    private string $name;
    private string $lastName;
    private string $middleName;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): AuthorDto
    {
        $this->name = $name;
        return $this;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): AuthorDto
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function getMiddleName(): string
    {
        return $this->middleName;
    }

    public function setMiddleName(string $middleName): AuthorDto
    {
        $this->middleName = $middleName;
        return $this;
    }


}