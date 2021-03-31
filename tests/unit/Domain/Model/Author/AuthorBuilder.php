<?php

declare(strict_types=1);

namespace App\Tests\unit\Domain\Model\Author;

use App\Domain\Model\Author\Author;
use App\Domain\Model\Author\Data\Alias;
use App\Domain\Model\Author\Data\Description;
use App\Domain\Model\Author\Data\Email;
use App\Domain\Model\Author\Data\Name;
use App\Domain\Model\Author\Data\ShortDescription;
use App\Domain\Model\Id\Id;

class AuthorBuilder
{
    private Id $id;
    private Name $name;
    private Alias $alias;
    private Email $email;
    private Description $description;
    private ShortDescription $shortDescription;
    private string $avatar;
    private array $socialMediaLinks;

    private function __construct()
    {
        $this->id = new Id('00000000-0000-0000-0000-000000000000');
        $this->name = new Name('a default name');
        $this->alias = new Alias('def_alias');
        $this->email = new Email('default@email.mh');
        $this->description = new Description('a default description');
        $this->shortDescription = new ShortDescription('a default short description');
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

    public function withName(Name $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function withAlias(Alias $alias): self
    {
        $this->alias = $alias;
        return $this;
    }

    public function withEmail(Email $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function withDescription(Description $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function withShortDescription(ShortDescription $shortDescription): self
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
