<?php

namespace App\Domain\Model\Author;

class Alias
{
    private const MAX_LENGTH = 9;

    private string $alias;

    public function __construct(?string $alias)
    {
        if (null === $alias) {
            throw new InvalidAuthorDataException('Author Alias is a mandatory field');
        }
        $this->setAlias($alias);
    }

    private function setAlias(string $alias)
    {
        $this->validate($alias);
        $this->alias = $alias;
    }

    private function validate(string $alias)
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

    public function toString(): string
    {
        return $this->alias;
    }
}
