<?php

namespace App\Domain\Model\Author;

class Alias
{
    const MAX_LENGTH = 9;
    private string $alias;

    public function __construct(string $alias)
    {
        $this->setAlias($alias);
    }

    private function setAlias(string $alias)
    {
        $this->isValid($alias);
        $this->alias = $alias;
    }

    private function isValid(string $alias)
    {
        if (strlen($alias) > self::MAX_LENGTH) {
            throw new InvalidAuthorDataException(
                sprintf("Alias should be less than %s characters", self::MAX_LENGTH)
            );
        }

        if (preg_match('/\s/', $alias)) {
            throw new InvalidAuthorDataException('Alias cannot contain whitespaces');
        }

        if (empty($alias)) {
            throw new InvalidAuthorDataException('Alias cannot be empty');
        }
    }
}
