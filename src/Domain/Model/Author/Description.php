<?php

declare(strict_types=1);

namespace App\Domain\Model\Author;

class Description
{
    private const MAX_LENGTH = 3500;

    private string $description;

    public function __construct(?string $description)
    {
        $this->setDescription($description);
    }

    private function setDescription(string $description)
    {
        $this->validate($description);
        $this->description = $description;
    }

    private function validate(string $shortDescription)
    {
        if (strlen($shortDescription) > self::MAX_LENGTH) {
            throw new InvalidAuthorDataException(
                sprintf("Description should be less than %s characters", self::MAX_LENGTH)
            );
        }
    }

    public function toString(): string
    {
        return $this->description;
    }
}
