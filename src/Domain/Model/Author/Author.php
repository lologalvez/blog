<?php

declare(strict_types=1);

namespace App\Domain\Model\Author;

use App\Domain\Model\Author\Data\Alias;
use App\Domain\Model\Author\Data\Description;
use App\Domain\Model\Author\Data\Email;
use App\Domain\Model\Author\Data\Name;
use App\Domain\Model\Author\Data\ShortDescription;
use App\Domain\Model\Id\Id;

class Author
{
    private Id $id;
    private Name $name;
    private Alias $alias;
    private Email $email;
    private Description $description;
    private ShortDescription $shortDescription;
    private string $avatar;
    private array $socialMediaLinks;

    public function __construct(
        Id $id,
        Name $name,
        Alias $alias,
        Email $email,
        Description $description,
        ShortDescription $shortDescription,
        string $avatar,
        array $socialMediaLinks
    ) {
        $this->setId($id);
        $this->setName($name);
        $this->setAlias($alias);
        $this->setEmail($email);
        $this->setDescription($description);
        $this->setShortDescription($shortDescription);
        $this->setAvatar($avatar);
        $this->setSocialMediaLinks($socialMediaLinks);
    }

    private function setId(Id $id)
    {
        $this->id = $id;
    }

    private function setName(Name $name)
    {
        $this->name = $name ;
    }

    private function setAlias(Alias $alias)
    {
        $this->alias = $alias;
    }

    private function setEmail(Email $email): void
    {
        $this->email = $email;
    }

    private function setDescription(Description $description): void
    {
        $this->description = $description;
    }

    private function setShortDescription(ShortDescription $shortDescription): void
    {
        $this->shortDescription = $shortDescription;
    }

    private function setAvatar(string $avatar): void
    {
        $this->avatar = $avatar;
    }

    private function setSocialMediaLinks(array $socialMediaLinks): void
    {
        $this->socialMediaLinks = $socialMediaLinks;
    }

    public function id(): Id
    {
        return $this->id;
    }

    public function name(): Name
    {
        return $this->name;
    }

    public function alias(): Alias
    {
        return $this->alias;
    }

    public function email(): Email
    {
        return $this->email;
    }

    public function description(): Description
    {
        return $this->description;
    }

    public function shortDescription(): ShortDescription
    {
        return $this->shortDescription;
    }

    public function avatar(): string
    {
        return $this->avatar;
    }

    public function socialMediaLinks(): array
    {
        return $this->socialMediaLinks;
    }
}
