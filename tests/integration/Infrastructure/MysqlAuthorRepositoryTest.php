<?php

namespace App\Tests\integration\Infrastructure;

use App\Domain\Model\Author\Author;
use App\Domain\Model\Author\Email;
use App\Domain\Model\Id\Id;
use App\Infrastructure\Model\Author\MySqlAuthorRepository;
use App\Tests\unit\Domain\Model\Author\AuthorBuilder;
use Doctrine\DBAL\DriverManager;
use PHPUnit\Framework\TestCase;

class MysqlAuthorRepositoryTest extends TestCase
{
    private const EMAIL = 'an@email.com';

    private $connection;
    private MySqlAuthorRepository $mySqlAuthorRepository;

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
        $author = AuthorBuilder::anAuthor()->withEmail(self::EMAIL)->build();

        $this->mySqlAuthorRepository->save($author);

        self::assertTrue($this->authorExists(self::EMAIL));
    }

    /** @test */
    public function should_retrieve_an_author_from_database(): void
    {
        $id = new Id('3fd4fb30-c9e2-415f-a167-092cdcf29f18');
        $author = AuthorBuilder::anAuthor()
            ->withEmail(self::EMAIL)
            ->withId($id)
            ->build();
        $this->saveAuthor($author);

        $retrievedAuthor = $this->mySqlAuthorRepository->findById($id);

        self::assertEquals($author, $retrievedAuthor);
    }

    /** @test */
    public function should_inform_if_email_exists(): void
    {
        $author = AuthorBuilder::anAuthor()->withEmail(self::EMAIL)->build();
        $this->saveAuthor($author);

        self::assertTrue($this->mySqlAuthorRepository->emailExists(new Email(self::EMAIL)));
    }

    /** @test */
    public function should_inform_if_email_does_not_exist(): void
    {
        self::assertFalse($this->mySqlAuthorRepository->emailExists(new Email(self::EMAIL)));
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

    /** @test */
    public function should_return_null_if_author_does_not_exist_for_a_given_author_id(): void
    {
        $aTestId = new Id('50bd5a5f-70d6-4037-b19b-36663e71c2fd');
        $this->deleteAuthorById($aTestId);

        self::assertNull($this->mySqlAuthorRepository->findById($aTestId));
    }

    private function saveAuthor(Author $author)
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

    private function clearDataBase(): void
    {
        $this->connection->executeQuery(
            "DELETE FROM authors where contact_email=:email",
            ['email' => self::EMAIL]
        );
    }

    private function deleteAuthorById(Id $aTestId)
    {
        $this->connection->executeQuery(
            "DELETE FROM authors where id=:id",
            ['id' => $aTestId->toString()]
        );
    }
}
