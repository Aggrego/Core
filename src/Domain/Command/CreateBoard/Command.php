<?php

namespace TimiTao\Construo\Domain\Command\CreateBoard;

class Command
{
    /** @var array */
    private $key;

    /** @var string */
    private $profileName;

    /** @var string */
    private $versionNumber;

    public function __construct(array $key, string $profileName, string $versionNumber)
    {
        $this->key = $key;
        $this->profileName = $profileName;
        $this->versionNumber = $versionNumber;
    }

    public function getKey(): array
    {
        return $this->key;
    }

    public function getProfileName(): string
    {
        return $this->profileName;
    }

    public function getVersionNumber(): string
    {
        return $this->versionNumber;
    }
}
