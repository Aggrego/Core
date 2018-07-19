<?php

namespace TimiTao\Construo\Domain\Query\GetUnit;

class Response
{
    /** @var string */
    private $profile;

    /** @var string  */
    private $versionNumber;

    /** @var string  */
    private $status;

    public function __construct(string $profile, string $versionNumber, string $status)
    {
        $this->profile = $profile;
        $this->versionNumber = $versionNumber;
        $this->status = $status;
    }

    public function getProfileName(): string
    {
        return $this->profile;
    }

    public function getVersionNumber(): string
    {
        return $this->versionNumber;
    }

    public function getStatus(): string
    {
        return $this->status;
    }
}
