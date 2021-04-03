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
        $authorAsArray = $author->asArray();

        $this->connection->insert(
            'authors',
            [
                'id' => $authorAsArray['id'],
                'name' => $authorAsArray['name'],
                'alias' => $authorAsArray['alias'],
                'contact_email' => $authorAsArray['email'],
                'personal_description' => $authorAsArray['description'],
                'short_description' => $authorAsArray['shortDescription'],
                'avatar' => $authorAsArray['avatar'],
                'social_media' => json_encode($authorAsArray['socialMediaLinks'], true)
            ]
        );
    }
}
