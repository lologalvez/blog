<?php

namespace App\Tests\integration\Infrastructure;

use App\Domain\Model\Author\Data\Email;
use App\Infrastructure\MySqlAuthorRepository;
use App\Tests\unit\Domain\Model\Author\AuthorBuilder;
use Doctrine\DBAL\DriverManager;
use PHPUnit\Framework\TestCase;

class MysqlAuthorRepositoryTest extends TestCase
{
    private const EMAIL = 'an@email.com';

    private $connection;
    private $mySqlAuthorRepository;

    protected function setUp(): void
    {
        $this->connection = DriverManager::getConnection([
            'dbname' => 'blog_db',
            'user' => 'root',
            'password' => 'password',
            'host' => 'blog.mysql',
            'driver' => 'pdo_mysql',
        ]);

        $this->mySqlAuthorRepository = new MySqlAuthorRepository($this->connection);

        $this->clearDataBase();
    }

    protected function tearDown(): void
    {
        $this->clearDataBase();
    }

    /** @test */
    public function should_save_an_author_to_database(): void
    {
        $author = AuthorBuilder::anAuthor()->withEmail(new Email(self::EMAIL))->build();

        $this->mySqlAuthorRepository->save($author);

        self::assertTrue($this->authorExists(self::EMAIL));
    }

    private function authorExists(string $email): bool
    {
        $authorResult = $this->connection->executeQuery(
            "SELECT contact_email FROM authors WHERE contact_email=:email",
            ['email' => $email]
        )->fetchOne();

        if (empty($authorResult)) {
            return false;
        }

        return true;
    }

    private function clearDataBase(): void
    {
        $this->connection->executeQuery(
            "DELETE FROM authors where contact_email=:email",
            ['email' => self::EMAIL]
        );
    }
}
