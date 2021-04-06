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
        $this->id = $id;
        $this->name = $name;
        $this->alias = $alias;
        $this->email = $email;
        $this->description = $description;
        $this->shortDescription = $shortDescription;
        $this->avatar = $avatar;
        $this->socialMediaLinks = $socialMediaLinks;
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
