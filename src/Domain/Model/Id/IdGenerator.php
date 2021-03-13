<?php

declare(strict_types=1);

namespace App\Domain\Model\Id;

interface IdGenerator
{
    public function generate(): Id;
}
