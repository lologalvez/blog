<?php


namespace App\Infrastructure;

use App\Domain\Model\Author\Author;
use Doctrine\DBAL\Driver\Connection;

class MySqlAuthorRepository
{
    /** @var Connection */
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function save(Author $author)
    {
    }
}
