<?php

namespace App\Tests\unit\Domain\Model\Author;

use App\Domain\Model\Author\Email;
use App\Domain\Model\Author\InvalidAuthorDataException;
use PHPUnit\Framework\TestCase;

class EmailTest extends TestCase
{
    /** @test */
    public function should_not_allow_an_invalid_email_format(): void
    {
        $this->expectException(InvalidAuthorDataException::class);
        $this->expectExceptionMessage('Invalid email format');
        new Email('an invalid email');
    }

    /** @test */
    public function should_not_be_null(): void
    {
        $this->expectException(InvalidAuthorDataException::class);
        $this->expectExceptionMessage('Author Email is a mandatory field');
        new Email(null);
    }
}
