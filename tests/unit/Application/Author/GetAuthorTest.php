<?php

declare(strict_types=1);

namespace App\Tests\unit\Application\Author;

use App\Application\Author\GetAuthor;
use App\Domain\Model\Author\AuthorNotFoundException;
use App\Domain\Model\Author\AuthorRepository;
use App\Domain\Model\Id\Id;
use App\Tests\unit\Domain\Model\Author\AuthorBuilder;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

class GetAuthorTest extends TestCase
{
    use ProphecyTrait;

    private const AUTHOR_ID = '0d67e364-813b-42a2-ba3f-20a86fc2c274';

    private $authorRepository;
    private GetAuthor $getAuthor;

    protected function setUp(): void
    {
        $this->authorRepository = $this->prophesize(AuthorRepository::class);
        $this->getAuthor = new GetAuthor($this->authorRepository->reveal());
    }

    /** @test */
    public function should_retrieve_an_author_from_repository()
    {
        $authorId = new Id(self::AUTHOR_ID);
        $author = AuthorBuilder::anAuthor()->withId($authorId)->build();
        $this->authorRepository->findById($authorId)->willReturn($author);

        $retrievedAuthor = $this->getAuthor->execute(self::AUTHOR_ID);

        self::assertEquals($retrievedAuthor, $author);
    }

    /** @test */
    public function should_throw_an_exception_if_author_does_not_exist(): void
    {
        $this->authorRepository->findById(new Id(self::AUTHOR_ID))->willReturn(null);

        $this->expectException(AuthorNotFoundException::class);
        $this->getAuthor->execute(self::AUTHOR_ID);
    }
}
