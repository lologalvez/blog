<?php

namespace App\Tests\unit\Domain\Model\Author\Data;

use App\Domain\Model\Author\InvalidAuthorDataException;
use App\Domain\Model\Author\Name;
use PHPUnit\Framework\TestCase;

class NameTest extends TestCase
{
    /**
     * @test
     * @dataProvider invalidNamesDataProvider
     */
    public function should_not_allow_numbers_or_special_characters(string $invalidName): void
    {
        $this->expectException(InvalidAuthorDataException::class);
        $this->expectExceptionMessage('Name must contain letters only');
        new Name($invalidName);
    }

    public function invalidNamesDataProvider(): array
    {
        return [
            'name that contains numbers' => ['4 n4m3'],
            'name that contains special characters' => ['@ n@me'],
        ];
    }

    /** @test */
    public function should_not_allow_names_with_length_over_15_characters(): void
    {
        $this->expectException(InvalidAuthorDataException::class);
        $this->expectExceptionMessage('Name should be less than 15 characters');
        new Name('a name that is too long');
    }

    /** @test */
    public function should_not_allow_an_empty_name(): void
    {
        $this->expectException(InvalidAuthorDataException::class);
        $this->expectExceptionMessage('Name cannot be empty');
        new Name('');
    }
}
