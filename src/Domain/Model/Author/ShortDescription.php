<?php

declare(strict_types=1);

namespace App\Domain\Model\Author;

class ShortDescription
{
    private const MAX_LENGTH = 275;

    private string $shortDescription;

    public function __construct(string $shortDescription)
    {
        $this->setShortDescription($shortDescription);
    }

    private function setShortDescription(string $shortDescription)
    {
        $this->validate($shortDescription);
        $this->shortDescription = $shortDescription;
    }

    private function validate(string $shortDescription)
    {
        if (strlen($shortDescription) > self::MAX_LENGTH) {
            throw new InvalidAuthorDataException(
                sprintf("Short Description should be less than %s characters", self::MAX_LENGTH)
            );
        }
    }

    public function toString(): string
    {
        return $this->shortDescription;
    }
}
