<?php

namespace App\Domain\Model\Author;

class Name
{
    private string $name;

    public function __construct(string $name)
    {
        $this->setName($name);
    }

    private function setName(string $name)
    {
        $this->isValid($name);
        $this->name = $name;
    }

    private function isValid(string $name)
    {
        if (!preg_match('/^([A-Za-z-À-ÿ\s]{1,15})$/', $name)) {
            throw new InvalidNameException();
        }
    }
}
