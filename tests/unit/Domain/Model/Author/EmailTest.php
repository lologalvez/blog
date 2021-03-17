<?php

namespace App\Tests\unit\Domain\Model\Author;

use App\Domain\Model\Author\Email;
use App\Domain\Model\Author\InvalidAuthorDataException;
use PHPUnit\Framework\TestCase;

class EmailTest extends TestCase
{
    /** @test */
    public function should_not_allow_invalid_email(): void
    {
        $this->expectException(new InvalidAuthorDataException('Invalid email format'));
        new Email('an invalid email');
    }
}
