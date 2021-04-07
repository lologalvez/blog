<?php

declare(strict_types=1);

namespace App\Application\Author;

use App\Domain\Model\Author\Author;
use App\Domain\Model\Author\AuthorRepository;
use App\Domain\Model\Id\Id;

class GetAuthor
{
    private AuthorRepository $authorRepository;

    public function __construct(AuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    public function execute(string $authorId): Author
    {
        $author = $this->authorRepository->findById(new Id($authorId));

        return $author;
    }
}
