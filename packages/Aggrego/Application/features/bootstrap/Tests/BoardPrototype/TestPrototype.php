<?php

declare(strict_types=1);

namespace Tests\BoardPrototype;

use Aggrego\Domain\Board\Id\Id;
use Aggrego\Domain\BoardPrototype\Metadata;
use Aggrego\Domain\BoardPrototype\Name;
use Aggrego\Domain\BoardPrototype\Prototype;
use Aggrego\Domain\Profile\Name as ProfileName;

class TestPrototype implements Prototype
{
    private $name;

    private $profileName;

    private $metadata;

    private $parentId;

    public function __construct(Name $name, ProfileName $profileName, Metadata $metadata, ?Id $parentId)
    {
        $this->name = $name;
        $this->profileName = $profileName;
        $this->metadata = $metadata;
        $this->parentId = $parentId;
    }

    public function getName(): Name
    {
        return $this->name;
    }

    public function getProfileName(): ProfileName
    {
        return $this->profileName;
    }

    public function getMetadata(): Metadata
    {
        return $this->metadata;
    }

    public function hasParentId(): bool
    {
        return $this->parentId !== null;
    }

    public function getParentId(): Id
    {
        return $this->parentId;
    }
}
