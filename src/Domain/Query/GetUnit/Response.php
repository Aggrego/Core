<?php

namespace TimiTao\Construo\Domain\Query\GetUnit;

use TimiTao\Construo\Domain\Model\Board\Entity\Board;
use TimiTao\Construo\Domain\Model\Board\ValueObject\Status;

class Response
{
    /** @var string */
    private $profile;

    /** @var string */
    private $versionNumber;

    /** @var string */
    private $status;

    /** @var string */
    private $body;

    private function __construct(string $profile, string $versionNumber, string $status)
    {
        $this->profile = $profile;
        $this->versionNumber = $versionNumber;
        $this->status = $status;
    }

    public static function createInvalidResponse(Query $query): self
    {
        return new self($query->getProfileName(), $query->getVersionNumber(), Status::INVALID);
    }

    public static function createValidResponse(Board $board): self
    {
        $profile = $board->getProfile();
        return new self(
            $profile->getName()->getValue(),
            $profile->getVersion()->getValue(),
            $board->getStatus()->getValue()
        );
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

    public function getBody(): string
    {
        return (string)$this->body;
    }
}
