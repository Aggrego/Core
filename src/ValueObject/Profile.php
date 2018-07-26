<?php

namespace Aggrego\Domain\ValueObject;

class Profile
{
    /** @var Name */
    private $name;

    /** @var Version */
    private $version;

    public function __construct(Name $name, Version $version)
    {
        $this->name = $name;
        $this->version = $version;
    }

    public function getName(): Name
    {
        return $this->name;
    }

    public function getVersion(): Version
    {
        return $this->version;
    }

    public function __toString(): string
    {
        return sprintf('%s:%s', $this->name->getValue(), $this->version->getValue());
    }
}
