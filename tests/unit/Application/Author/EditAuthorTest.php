<?php

declare(strict_types=1);

namespace App\Tests\unit\Application\Author;

use App\Application\Author\EditAuthor;
use App\Domain\Model\Author\AuthorRepository;
use App\Domain\Model\Id\Id;
use App\Tests\unit\Domain\Model\Author\AuthorBuilder;
use PHPUnit\Framework\TestCase;

class EditAuthorTest extends TestCase
{
    private const AUTHOR_ID = '0d67e364-813b-42a2-ba3f-20a86fc2c274';

    /** @test */
    public function should_edit_an_authors_information(): void
    {
        $authorRepository = $this->prophesize(AuthorRepository::class);
        $editAuthor = new EditAuthor($authorRepository->reveal());

        $anAuthorId = new Id(self::AUTHOR_ID);
        $authorData = [
            'id' => self::AUTHOR_ID,
            'name' => 'an author name',
            'alias' => 'an_alias',
            'contact_email' => 'an@email.dev',
            'personal_description' => 'a description',
            'short_description' => 'a short description',
            'avatar' => 'an avatar',
            'social_media' => [
                'instagram' => 'an instagram link',
            ],
        ];
        $authorRepository->findById($anAuthorId)
            ->willReturn(AuthorBuilder::anAuthor()->build());

        $editAuthor->execute($authorData);

        $expectedAuthor = AuthorBuilder::anAuthor()
            ->withId($anAuthorId)
            ->withName('an author name')
            ->withAlias('an_alias')
            ->withEmail('an@email.dev')
            ->withDescription('a description')
            ->withShortDescription('a short description')
            ->withAvatar('an avatar')
            ->withSocialMediaLinks(['instagram' => 'an instagram link'])
            ->build();
        $authorRepository->edit($anAuthorId, $expectedAuthor)->shouldHaveBeenCalled();
    }
}
