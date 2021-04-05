<?php

declare(strict_types=1);

namespace App\Application\Author;

use App\Domain\Model\Author\Author;
use App\Domain\Model\Author\AuthorRepository;
use App\Domain\Model\Author\Alias;
use App\Domain\Model\Author\Description;
use App\Domain\Model\Author\Email;
use App\Domain\Model\Author\Name;
use App\Domain\Model\Author\ShortDescription;
use App\Domain\Model\Id\IdGenerator;

class CreateAuthor
{
    private AuthorRepository $authorRepository;
    private IdGenerator $idGenerator;

    public function __construct(AuthorRepository $authorRepository, IdGenerator $idGenerator)
    {
        $this->authorRepository = $authorRepository;
        $this->idGenerator = $idGenerator;
    }

    public function execute(array $authorData): void
    {
        $author = new Author(
            $this->idGenerator->generate(),
            new Name($authorData['name']),
            new Alias($authorData['alias']),
            new Email($authorData['email']),
            new Description($authorData['description']),
            new ShortDescription($authorData['short_description']),
            $authorData['avatar'],
            $authorData['social_media_links']
        );

        $this->authorRepository->save($author);
    }
}
