<?php

declare(strict_types=1);

namespace App\Domain\Model\Id;

use Webmozart\Assert\Assert;

class Id
{
    private string $id;

    public function __construct(?string $id)
    {
        $id = mb_strtolower($id);
        Assert::uuid($id);
        $this->id = $id;
    }

    public function toString(): string
    {
        return $this->id;
    }
}
