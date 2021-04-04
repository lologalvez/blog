<?php

namespace App;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class JsonResponseBuilder
{
    public static function success(array $data): JsonResponse
    {
        return new JsonResponse(['data' => $data], Response::HTTP_OK);
    }

    public static function error(array $error): JsonResponse
    {
        return new JsonResponse(['error' => $error], Response::HTTP_BAD_REQUEST);
    }

    public static function created(): JsonResponse
    {
        return new JsonResponse(null, Response::HTTP_CREATED);
    }

    public static function createdWithData(array $data)
    {
        return new JsonResponse(['data' => $data], Response::HTTP_CREATED);
    }

    public static function notFound(): JsonResponse
    {
        return new JsonResponse(null, Response::HTTP_NOT_FOUND);
    }

    public static function badRequest($content = null): JsonResponse
    {
        return new JsonResponse($content, Response::HTTP_BAD_REQUEST);
    }

    public static function emptySuccess(): JsonResponse
    {
        return new JsonResponse(null, Response::HTTP_OK);
    }

    public static function unprocessableEntity(): JsonResponse
    {
        return new JsonResponse(null, Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public static function forbidden(): JsonResponse
    {
        return new JsonResponse(null, Response::HTTP_FORBIDDEN);
    }
}
