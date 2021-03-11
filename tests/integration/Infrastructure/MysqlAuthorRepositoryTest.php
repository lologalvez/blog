<?php


namespace App\Tests\integration\Infrastructure;

use App\Infrastructure\MySqlAuthorRepository;
use App\Tests\unit\Domain\Model\Author\AuthorBuilder;
use Doctrine\DBAL\DriverManager;
use PHPUnit\Framework\TestCase;

class MysqlAuthorRepositoryTest extends TestCase
{
    private $connection;

    protected function setUp(): void
    {
        $this->connection = DriverManager::getConnection([
            'dbname' => 'blog_db',
            'user' => 'root',
            'password' => 'password',
            'host' => 'blog.mysql',
            'driver' => 'pdo_mysql',
        ]);
    }
    /** @test */
    public function should_save_an_author_to_database(): void
    {
        $email = 'an email';
        $author = AuthorBuilder::anAuthor()->withEmail($email)->build();
        $mysqlAuthorRepository = new MySqlAuthorRepository($this->connection);

        $mysqlAuthorRepository->save($author);

        self::assertTrue($this->authorExists($email));
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
}
