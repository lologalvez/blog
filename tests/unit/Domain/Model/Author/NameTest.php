<?php

namespace App\Tests\unit\Domain\Model\Author;

use App\Domain\Model\Author\InvalidNameException;
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
        $this->expectException(InvalidNameException::class);
        new Name($invalidName);
    }

    public function invalidNamesDataProvider()
    {
        return [
            'name that contains numbers' => ['a1b2c3'],
            'name that contains special characters' => ['n@ames']
        ];
    }
}
