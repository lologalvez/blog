<?php

declare(strict_types=1);

namespace App\Tests\unit\Application\Author;

use App\Application\Author\CreateAuthor;
use App\Domain\Model\Author\AuthorRepository;
use App\Domain\Model\Author\Alias;
use App\Domain\Model\Author\Description;
use App\Domain\Model\Author\Email;
use App\Domain\Model\Author\Name;
use App\Domain\Model\Author\ShortDescription;
use App\Domain\Model\Id\Id;
use App\Domain\Model\Id\IdGenerator;
use App\Tests\unit\Domain\Model\Author\AuthorBuilder;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

class CreateAuthorTest extends TestCase
{
    use ProphecyTrait;

    private const AUTHOR_ID = '0d67e364-813b-42a2-ba3f-20a86fc2c274';

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
        $authorData = [
            'name' => 'an author name',
            'alias' => 'an_alias',
            'email' => 'an@email.dev',
            'description' => 'a description',
            'short_description' => 'a short description',
            'avatar' => 'an avatar',
            'social_media_links' => [
                'instagram' => 'an instagram link',
            ],
        ];
        $this->idGenerator->generate()->willReturn(new Id(self::AUTHOR_ID));

        $this->createAuthor->execute($authorData);

        $expectedAuthor = AuthorBuilder::anAuthor()
            ->withId(new Id(self::AUTHOR_ID))
            ->withName('an author name')
            ->withAlias('an_alias')
            ->withEmail('an@email.dev')
            ->withDescription('a description')
            ->withShortDescription('a short description')
            ->withAvatar('an avatar')
            ->withSocialMediaLinks(['instagram' => 'an instagram link'])
            ->build();
        $this->authorRepository->save($expectedAuthor)->shouldHaveBeenCalled();
    }
}
