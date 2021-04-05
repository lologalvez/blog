<?php

declare(strict_types=1);

namespace App\Controller\Authors;

use App\Application\Author\CreateAuthor;
use App\Application\Author\GetAuthor;
use App\Domain\Model\Author\InvalidAuthorDataException;
use App\Infrastructure\Request;
use App\JsonResponseBuilder;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthorsController
{
    private CreateAuthor $createAuthor;
    private ?GetAuthor $getAuthor;

    public function __construct(CreateAuthor $createAuthor, GetAuthor $getAuthor = null)
    {
        $this->createAuthor = $createAuthor;
        $this->getAuthor = $getAuthor;
    }

    public function create(Request $request): JsonResponse
    {
        $authorData = $request->getJsonDecodedContent();
        try {
            $this->createAuthor->execute($authorData);
            return JsonResponseBuilder::created();
        } catch (InvalidAuthorDataException $e) {
            return JsonResponseBuilder::error(['message' => $e->getMessage()]);
        }
    }

    public function get(string $authorId): JsonResponse
    {
        return new JsonResponse();
    }
}
