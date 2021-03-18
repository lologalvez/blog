<?php

namespace App\Domain\Model\Author\Data;

class Name
{
    private const MAX_LENGTH = 15;

    private string $name;

    public function __construct(string $name)
    {
        $this->setName($name);
    }

    private function setName(string $name)
    {
        $this->validate($name);
        $this->name = $name;
    }

    private function validate(string $name)
    {
        if (empty($name)) {
            throw new InvalidAuthorDataException('Name cannot be empty');
        }

        if (strlen($name) > self::MAX_LENGTH) {
            throw new InvalidAuthorDataException(
                sprintf("Name should be less than %s characters", self::MAX_LENGTH)
            );
        }

        if (!preg_match('/^[\p{L}\s]+$/u', $name)) {
            throw new InvalidAuthorDataException('Name must contain letters only');
        }
    }
}
