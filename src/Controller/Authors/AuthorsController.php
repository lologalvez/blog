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
        $formFields = $request->getJsonDecodedContent();
        try {
            $this->createAuthor->execute($formFields);
            return JsonResponseBuilder::created();
        } catch (InvalidAuthorDataException $e) {
            return JsonResponseBuilder::error(['message' => $e->getMessage()]);
        }
    }
}
