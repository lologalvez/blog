<?php

namespace App\Tests\unit\Domain\Model\Author;

use App\Domain\Model\Author\InvalidAliasException;
use PHPUnit\Framework\TestCase;
use App\Domain\Model\Author\Alias;

class AliasTest extends TestCase
{
    /** @test */
    public function should_not_allow_aliases_with_length_over_9_characters(): void
    {
        $this->expectException(InvalidAliasException::class);
        new Alias('an alias that is too long');
    }

    /** @ test */
    public function should_not_allow_aliases_with_white_spaces(): void
    {
        $this->expectException(InvalidAliasException::class);
        new Alias('an alias');
    }


    /** @ test */
    public function should_not_allow_an_empty_alias(): void
    {
        $this->expectException(InvalidAliasException::class);
        new Alias('');
    }
}
