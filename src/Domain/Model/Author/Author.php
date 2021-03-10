<?php

declare(strict_types=1);

namespace App\Domain\Model\Author;

class Author
{
    private string $id;
    private string $name;
    private string $alias;
    private string $email;
    private string $description;
    private string $shortDescription;
    private string $avatar;
    private array $socialMediaLinks;

    public function __construct(
        string $id,
        string $name,
        string $alias,
        string $email,
        string $description,
        string $shortDescription,
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

    private function setId(string $id)
    {
        $this->id = $id;
    }

    private function setName(string $name)
    {
        $this->name = $name ;
    }

    private function setAlias(string $alias)
    {
        $this->alias = $alias;
    }

    private function setEmail(string $email): void
    {
        $this->email = $email;
    }

    private function setDescription(string $description): void
    {
        $this->description = $description;
    }

    private function setShortDescription(string $shortDescription): void
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
}
