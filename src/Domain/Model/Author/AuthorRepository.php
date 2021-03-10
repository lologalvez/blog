<?php

declare(strict_types=1);

namespace App\Domain\Model\Author;

interface AuthorRepository
{
    public function save(Author $author): void;
}
