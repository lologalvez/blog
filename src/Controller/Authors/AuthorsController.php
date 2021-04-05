<?php

declare(strict_types=1);

namespace App\Controller\Authors;

use App\Application\Author\CreateAuthor;
use App\Domain\Model\Author\InvalidAuthorDataException;
use App\Infrastructure\Request;
use App\JsonResponseBuilder;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthorsController
{
    private CreateAuthor $createAuthor;

    public function __construct(CreateAuthor $createAuthor)
    {
        $this->createAuthor = $createAuthor;
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
}
