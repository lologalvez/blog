<?php

namespace App\Infrastructure\Model\Author;

use App\Domain\Model\Author\Author;
use App\Domain\Model\Author\AuthorRepository;
use App\Domain\Model\Author\Email;
use App\Domain\Model\Id\Id;
use Doctrine\DBAL\Driver\Connection;

class MySqlAuthorRepository implements AuthorRepository
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function save(Author $author): void
    {
        $authorAsArray = $author->asArray();

        $this->connection->insert(
            'authors',
            [
                'id' => $authorAsArray['id'],
                'name' => $authorAsArray['name'],
                'alias' => $authorAsArray['alias'],
                'contact_email' => $authorAsArray['contact_email'],
                'personal_description' => $authorAsArray['personal_description'],
                'short_description' => $authorAsArray['short_description'],
                'avatar' => $authorAsArray['avatar'],
                'social_media' => json_encode($authorAsArray['social_media'], true)
            ]
        );
    }

    public function findById(Id $authorId): ?Author
    {
        $authorData = $this->connection
            ->executeQuery(
                'SELECT * FROM authors WHERE id=:authorId',
                ['authorId' => $authorId->toString()]
            )->fetch();

        if (false === $authorData) {
            return null;
        }

        $authorData['social_media'] = json_decode($authorData['social_media'], true);

        return Author::createFrom(new Id($authorData['id']), $authorData);
    }

    public function emailExists(Email $email): bool
    {
        $authorResult = $this->connection->executeQuery(
            "SELECT contact_email FROM authors WHERE contact_email=:email",
            ['email' => $email->toString()]
        )->fetchOne();

        if (empty($authorResult)) {
            return false;
        }

        return true;
    }

    public function edit(Id $id, Author $author): void
    {
        // TODO: Implement edit() method.
    }
}
