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
                'id' => $author->id(),
                'name' => $author->name(),
                'alias' => $author->alias(),
                'contact_email' => $author->email(),
                'personal_description' => $author->description(),
                'short_description' => $author->shortDescription(),
                'avatar' => $author->avatar(),
                'social_media' => json_encode($author->socialMediaLinks(), true)
            ]
        );
    }
}
