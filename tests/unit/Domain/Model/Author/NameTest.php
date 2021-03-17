<?php

namespace App\Tests\unit\Domain\Model\Author;

use App\Domain\Model\Author\InvalidNameException;
use App\Domain\Model\Author\Name;
use App\Domain\Model\Author\NameIsTooLongException;
use PHPUnit\Framework\TestCase;

class NameTest extends TestCase
{
    /**
     * @test
     * @dataProvider invalidNamesDataProvider
     */
    public function should_not_allow_numbers_or_special_characters(string $invalidName): void
    {
        $this->expectException(InvalidNameException::class);
        new Name($invalidName);
    }

    public function invalidNamesDataProvider(): array
    {
        return [
            'name that contains numbers' => ['a1b2c3'],
            'name that contains special characters' => ['n@ames']
        ];
    }

    /** @test */
    public function should_not_allow_names_with_length_over_15_characters(): void
    {
        $this->expectException(NameIsTooLongException::class);
        new Name('a name that is over fifteen characters');
    }
}
