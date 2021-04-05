<?php

namespace App\Domain\Model\Author;

class Email
{
    private string $email;

    public function __construct(string $email)
    {
        $this->setEmail($email);
    }

    private function setEmail(string $email)
    {
        $this->validate($email);
        $this->email = $email;
    }

    private function validate(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidAuthorDataException('Invalid email format');
        }
    }

    public function toString(): string
    {
        return $this->email;
    }
}
