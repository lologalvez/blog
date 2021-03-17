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
        if (preg_match('/^([A-Za-z\u00C0-\u00D6\u00D8-\u00f6\u00f8-\u00ff\s]*)$/', $name)) {
            throw new InvalidNameException();
        }
    }
}
