<?php

declare(strict_types=1);

namespace App\Domain\Model\Author;

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

    private function __construct(
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

    public static function createFrom(Id $id, array $authorData): self
    {
        return new self(
            $id,
            new Name($authorData['name'] ?? null),
            new Alias($authorData['alias'] ?? null),
            new Email($authorData['email'] ?? null),
            new Description($authorData['description'] ?? ''),
            new ShortDescription($authorData['short_description'] ?? ''),
            $authorData['avatar'] ?? '',
            $authorData['social_media_links'] ?? []
        );
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

    public function asArray(): array
    {
        return [
            'id' => $this->id->toString(),
            'name' => $this->name->toString(),
            'alias' => $this->alias->toString(),
            'email' => $this->email->toString(),
            'description' => $this->description->toString(),
            'shortDescription' => $this->shortDescription->toString(),
            'avatar' => $this->avatar,
            'socialMediaLinks' => $this->socialMediaLinks,
        ];
    }
}
