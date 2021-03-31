<?php

namespace App\Infrastructure;

use App\Domain\Model\Author\Author;
use Doctrine\DBAL\Driver\Connection;

class MySqlAuthorRepository
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function save(Author $author)
    {
        $this->connection->insert(
            'authors',
            [
                'id' => $author->id()->toString(),
                'name' => $author->name()->toString(),
                'alias' => $author->alias()->toString(),
                'contact_email' => $author->email()->toString(),
                'personal_description' => $author->description()->toString(),
                'short_description' => $author->shortDescription()->toString(),
                'avatar' => $author->avatar(),
                'social_media' => json_encode($author->socialMediaLinks(), true)
            ]
        );
    }
}
