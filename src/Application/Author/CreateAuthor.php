<?php

declare(strict_types=1);

namespace App\Application\Author;

use App\Domain\Model\Author\Author;
use App\Domain\Model\Author\AuthorRepository;
use App\Domain\Model\Author\Email;
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
        $this->isEmailUnique($authorData['contact_email']);

        $author = Author::createFrom(
            $this->idGenerator->generate(),
            $authorData
        );

        $this->authorRepository->save($author);
    }

    private function isEmailUnique($contact_email): void
    {
        if ($this->authorRepository->emailExists(new Email($contact_email))) {
            throw new AuthorExistsException();
        }
    }
}
