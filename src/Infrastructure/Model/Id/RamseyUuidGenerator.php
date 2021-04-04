<?php

declare(strict_types=1);

namespace App\Infrastructure\Model\Id;

use App\Domain\Model\Id\Id;
use App\Domain\Model\Id\IdGenerator;
use Ramsey\Uuid\Uuid;

class RamseyUuidGenerator implements IdGenerator
{
    public function generate(): Id
    {
        return new Id(Uuid::uuid4()->toString());
    }
}
