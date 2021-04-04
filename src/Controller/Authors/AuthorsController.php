<?php

declare(strict_types=1);

namespace App\Controller\Authors;

use App\Application\Author\CreateAuthor;
use App\JsonResponseBuilder;
use App\Infrastructure\Request;

class AuthorsController
{
    private CreateAuthor $createAuthor;

    public function __construct(CreateAuthor $createAuthor)
    {
        $this->createAuthor = $createAuthor;
    }

    public function create(Request $request)
    {
        $formFields = $request->getJsonDecodedContent();

        $this->createAuthor->execute($formFields);

        return JsonResponseBuilder::created();
    }
}
