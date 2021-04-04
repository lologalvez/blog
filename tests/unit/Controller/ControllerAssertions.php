<?php

namespace App\Tests\unit\Controller;

use PHPUnit\Framework\Assert;

class ControllerAssertions
{
    public static function assertResponse($expectedResponse, $response): void
    {
        Assert::assertEquals($expectedResponse->getStatusCode(), $response->getStatusCode());
        Assert::assertEquals(json_decode($expectedResponse->getContent()), json_decode($response->getContent()));
    }
}
