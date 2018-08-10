<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Profile;

use Aggrego\Domain\Profile\ValueObject\Name;
use Aggrego\Domain\Profile\ValueObject\Version;

class Profile
{
    private const SEPARATOR = ':';

    /** @var Name */
    private $name;

    /** @var Version */
    private $version;

    private function __construct(Name $name, Version $version)
    {
        $this->name = $name;
        $this->version = $version;
    }

    public static function createFrom(string $name, string $version): self
    {
        return new self(
            new Name($name),
            new Version($version)
        );
    }

    public function equal(self $profile): bool
    {
        return $this->name->equal($profile->name)
            && $this->version->equal($profile->version);
    }

    public function __toString(): string
    {
        return $this->name->getValue() . self::SEPARATOR . $this->version->getValue();
    }
}
