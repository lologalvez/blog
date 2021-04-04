<?php

declare(strict_types=1);

namespace App\Controller\Authors;

use App\Application\Author\CreateAuthor;
use App\JsonResponseBuilder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

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

        $this->createAuthor->execute($formFields);

        return JsonResponseBuilder::created();
    }
}
