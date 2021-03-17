<?php

namespace App\Tests\unit\Domain\Model\Author;

use App\Domain\Model\Author\InvalidAliasException;
use App\Domain\Model\Author\InvalidAuthorDataException;
use PHPUnit\Framework\TestCase;
use App\Domain\Model\Author\Alias;

class AliasTest extends TestCase
{
    /** @test */
    public function should_not_allow_aliases_with_length_over_9_characters(): void
    {
        $this->expectException(InvalidAuthorDataException::class);
        $this->expectExceptionMessage('Alias is too long');
        new Alias('an alias that is too long');
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
