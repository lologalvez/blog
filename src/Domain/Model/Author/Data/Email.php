<?php

namespace App\Domain\Model\Author\Data;

class Email
{
    private string $email;

    public function __construct(string $email)
    {
        $this->setEmail($email);
    }

    private function setEmail(string $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidAuthorDataException('Invalid email format');
        }

        $this->email = $email;
    }
}
