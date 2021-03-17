<?php


namespace App\Domain\Model\Author;

class Name
{
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}
