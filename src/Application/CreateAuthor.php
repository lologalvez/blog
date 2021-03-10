<?php

declare(strict_types=1);

namespace App\Application;

use App\Domain\Model\Author\Author;
use App\Domain\Model\Author\AuthorRepository;
use App\Domain\Utils\IdGenerator;

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
            $authorData['name'],
            $authorData['alias'],
            $authorData['email'],
            $authorData['description'],
            $authorData['short_description'],
            $authorData['avatar'],
            $authorData['social_media_links']
        );

        $this->authorRepository->save($author);
    }
}
