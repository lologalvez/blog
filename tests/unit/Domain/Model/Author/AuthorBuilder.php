<?php

declare(strict_types=1);

namespace App\Tests\unit\Domain\Model\Author;

use App\Domain\Model\Author\Author;
use App\Domain\Model\Id\Id;

class AuthorBuilder
{
    private Id $id;
    private string $name;
    private string $alias;
    private string $email;
    private string $description;
    private string $shortDescription;
    private string $avatar;
    private array $socialMediaLinks;

    private function __construct()
    {
        $this->id = new Id('00000000-0000-0000-0000-000000000000');
        $this->name = 'a default author name';
        $this->alias = 'a default alias';
        $this->email = 'a default email';
        $this->description = 'a default description';
        $this->shortDescription = 'a default short description';
        $this->avatar = 'a default avatar';
        $this->socialMediaLinks = ['a default social network' => 'idem'];
    }

    public static function anAuthor(): self
    {
        return new self();
    }
    public function withId(Id $id): self
    {
        $this->id = $id;
        return $this;
    }
    public function withName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function withAlias(string $alias): self
    {
        $this->alias = $alias;
        return $this;
    }

    public function withEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function withDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function withShortDescription(string $shortDescription): self
    {
        $this->shortDescription = $shortDescription;
        return $this;
    }

    public function withAvatar(string $avatar): self
    {
        $this->avatar = $avatar;
        return $this;
    }
    public function withSocialMediaLinks(array $socialMediaLinks): self
    {
        $this->socialMediaLinks = $socialMediaLinks;
        return $this;
    }
    public function build(): Author
    {
        return new Author(
            $this->id,
            $this->name,
            $this->alias,
            $this->email,
            $this->description,
            $this->shortDescription,
            $this->avatar,
            $this->socialMediaLinks
        );
    }
}
