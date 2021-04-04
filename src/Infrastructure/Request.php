<?php

namespace App\Infrastructure;

use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

use function json_decode;

class Request extends SymfonyRequest
{
    public function getJsonDecodedContent(): array
    {
        try {
            $content = $this->getContent();
            return json_decode($content, true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            throw new RequestBodyIsNotAValidJSON($e->getMessage(), $e->getCode(), $e);
        }
    }
}
