<?php

namespace TimiTao\Construo\Domain\Model\Board\ValueObject;

class Source
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
}
