<?php

declare(strict_types=1);

namespace App\Tests\Application;

use App\Application\CreateAuthor;
use App\Domain\Model\Author\AuthorRepository;
use App\Domain\Utils\IdGenerator;
use App\Tests\Domain\Model\Author\AuthorBuilder;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

class CreateAuthorTest extends TestCase
{
    use ProphecyTrait;

    private $authorRepository;
    private $idGenerator;
    private CreateAuthor $createAuthor;

    public function setUp(): void
    {
        $this->authorRepository = $this->prophesize(AuthorRepository::class);
        $this->idGenerator = $this->prophesize(IdGenerator::class);
        $this->createAuthor = new CreateAuthor(
            $this->authorRepository->reveal(),
            $this->idGenerator->reveal()
        );
    }

    /** @test */
    public function should_save_an_author_to_repository(): void
    {
        $author = [
            'name' => 'an author name',
            'alias' => 'an author alias',
            'email' => 'an@email.dev',
            'description' => 'a description',
            'short_description' => 'a short description',
            'avatar' => 'an avatar',
            'social_media_links' => [
                'instagram' => 'an instagram link',
            ],
        ];
        $this->idGenerator->generate()->willReturn('an author id');

        $this->createAuthor->execute($author);

        $expectedAuthor = AuthorBuilder::anAuthor()
            ->withId('an author id')
            ->withName('an author name')
            ->withAlias('an author alias')
            ->withEmail('an@email.dev')
            ->withDescription('a description')
            ->withShortDescription('a short description')
            ->withAvatar('an avatar')
            ->withSocialMediaLinks(['instagram' => 'an instagram link'])
            ->build();
        $this->authorRepository->save($expectedAuthor)->shouldHaveBeenCalled();
    }
}
