<?php

namespace App\Domain\Model\Author;

class Alias
{
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
        if  (!preg_match('/^[^\s]{1,9}$/', $alias)) {
            throw new InvalidAliasException();
        }
    }
}
