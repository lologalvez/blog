<?php

namespace App\Tests\unit\Domain\Model\Author\Data;

use App\Domain\Model\Author\InvalidAuthorDataException;
use PHPUnit\Framework\TestCase;
use App\Domain\Model\Author\Alias;

class AliasTest extends TestCase
{
    /** @test */
    public function should_not_allow_aliases_with_length_over_9_characters(): void
    {
        $this->expectException(InvalidAuthorDataException::class);
        $this->expectExceptionMessage("Alias should be less than 9 characters");
        new Alias('an_alias_that_is_too_long');
    }

    /** @test */
    public function should_not_allow_aliases_with_white_spaces(): void
    {
        $this->expectException(InvalidAuthorDataException::class);
        $this->expectExceptionMessage('Alias cannot contain whitespaces');
        new Alias('an alias');
    }

    /** @test */
    public function should_not_allow_an_empty_alias(): void
    {
        $this->expectException(InvalidAuthorDataException::class);
        $this->expectExceptionMessage('Alias cannot be empty');
        new Alias('');
    }
}
