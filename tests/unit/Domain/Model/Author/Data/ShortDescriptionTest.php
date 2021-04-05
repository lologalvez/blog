<?php

namespace App\Tests\unit\Domain\Model\Author\Data;

use App\Domain\Model\Author\InvalidAuthorDataException;
use App\Domain\Model\Author\ShortDescription;
use PHPUnit\Framework\TestCase;

class ShortDescriptionTest extends TestCase
{
    /** @test */
    public function should_not_allow_more_than_275_characters(): void
    {
        $this->expectException(InvalidAuthorDataException::class);
        $this->expectExceptionMessage('Short Description should be less than 275 characters');
        new ShortDescription('Morbi maximus, libero quis auctor venenatis, ligula metus condimentum enim, eget convallis neque mauris et leo. Cras porttitor metus sit amet lectus porttitor lacinia. Duis pulvinar, risus in aliquet imperdiet, diam magna convallis eros, sagittis gravida libero leo a quam le.');
    }
}
