<?php

declare(strict_types=1);

namespace App\Domain\Model\Author;

use App\Domain\Model\Id\Id;

interface AuthorRepository
{
    public function save(Author $author): void;

    public function findById(Id $authorId): Author;
}
