<?php

declare(strict_types=1);

namespace App\Domain\Utils;

interface IdGenerator
{
    public function generate(): string;
}
