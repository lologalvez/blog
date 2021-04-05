<?php

declare(strict_types=1);

namespace App\Tests\unit\Controller\Authors;

use App\Application\Author\CreateAuthor;
use App\Controller\Authors\AuthorsController;
use App\Domain\Model\Author\InvalidAuthorDataException;
use App\JsonResponseBuilder;
use App\Tests\unit\Controller\ControllerAssertions;
use App\Tests\unit\Controller\RequestBuilder;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Prophecy\PhpUnit\ProphecyTrait;

class AuthorsControllerTest extends TestCase
{
    use ProphecyTrait;

    private $createAuthor;
    private AuthorsController $controller;

    protected function setUp(): void
    {
        $this->createAuthor = $this->prophesize(CreateAuthor::class);
        $this->controller = new AuthorsController($this->createAuthor->reveal());
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
}
