<?php

namespace App\Domain\Model\Author;

use Exception;
use Throwable;

class AuthorNotFoundException extends Exception
{
    public function __construct($message = "Author not found", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
