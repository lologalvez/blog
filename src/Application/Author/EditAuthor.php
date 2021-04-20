<?php

declare(strict_types=1);

namespace App\Application\Author;

use App\Domain\Model\Author\Author;
use App\Domain\Model\Author\AuthorNotFoundException;
use App\Domain\Model\Author\AuthorRepository;
use App\Domain\Model\Id\Id;

class EditAuthor
{
    private AuthorRepository $authorRepository;

    public function __construct(AuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    public function execute(array $authorData)
    {
        $authorId = new Id($authorData['id']);
        $this->authorIdExists($authorId);
        $this->authorRepository->edit($authorId, Author::createFrom($authorId, $authorData));
    }

    private function authorIdExists(Id $authorId): void
    {
        $author = $this->authorRepository->findById($authorId);
        if (null === $author) {
            throw new AuthorNotFoundException();
        }
    }
}
