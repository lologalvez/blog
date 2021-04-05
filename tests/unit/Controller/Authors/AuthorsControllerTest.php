<?php

declare(strict_types=1);

namespace App\Tests\unit\Controller\Authors;

use App\Application\Author\CreateAuthor;
use App\Application\Author\GetAuthor;
use App\Controller\Authors\AuthorsController;
use App\Domain\Model\Author\InvalidAuthorDataException;
use App\Domain\Model\Id\Id;
use App\JsonResponseBuilder;
use App\Tests\unit\Controller\ControllerAssertions;
use App\Tests\unit\Controller\RequestBuilder;
use App\Tests\unit\Domain\Model\Author\AuthorBuilder;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Prophecy\PhpUnit\ProphecyTrait;

class AuthorsControllerTest extends TestCase
{
    use ProphecyTrait;

    private const AUTHOR_ID = '00000000-0000-0000-0000-000000000000';

    private $createAuthor;
    private $getAuthor;
    private AuthorsController $controller;

    protected function setUp(): void
    {
        $this->createAuthor = $this->prophesize(CreateAuthor::class);
        $this->getAuthor = $this->prophesize(GetAuthor::class);
        $this->controller = new AuthorsController($this->createAuthor->reveal(), $this->getAuthor->reveal());
    }

    /** @test */
    public function should_return_successful_when_an_author_is_created(): void
    {
        $authorData = [
            'name' => 'an author name',
            'alias' => 'an_alias',
            'email' => 'an@email.dev',
            'description' => 'a description',
            'short_description' => 'a short description',
            'avatar' => 'an avatar',
            'social_media_links' => [
                'instagram' => 'an instagram link',
            ],
        ];
        $request = RequestBuilder::post()
            ->to('/authors')
            ->withFormFields($authorData)
            ->build();

        $response = $this->controller->create($request);

        $this->createAuthor->execute($authorData)->shouldHaveBeenCalled();
        ControllerAssertions::assertResponse(JsonResponseBuilder::created(), $response);
    }

    /** @test */
    public function should_return_error_when_author_creation_fails(): void
    {
        $authorData = ['author' => 'data'];
        $request = RequestBuilder::post()
            ->to('/authors')
            ->withFormFields($authorData)
            ->build();
        $exception = new InvalidAuthorDataException('an error message');
        $this->createAuthor->execute(Argument::any())->willThrow($exception);

        $response = $this->controller->create($request);

        $expectedError = ['message' => 'an error message'];
        ControllerAssertions::assertResponse(JsonResponseBuilder::error($expectedError), $response);
    }

    /** @test */
    public function should_return_an_existing_author(): void
    {
        self::markTestIncomplete('WIP');
        $author = AuthorBuilder::anAuthor()->withId(new Id(self::AUTHOR_ID))->build();
        $this->getAuthor->execute(Argument::any())->willReturn($author);

        $response = $this->controller->get(self::AUTHOR_ID);

        ControllerAssertions::assertResponse(JsonResponseBuilder::success($author->asArray()), $response);
    }
}
