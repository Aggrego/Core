<?php

namespace TimiTao\Construo\Domain\Api\Query\GetUnit;

use TimiTao\Construo\Domain\Model\Unit\Entity\Unit;

class Response
{
    public const INVALID = 'invalid';
    public const DONE = 'done';

    /** @var string */
    private $profile;

    /** @var string */
    private $versionNumber;

    /** @var string */
    private $status;

    /** @var string */
    private $body;

    private function __construct(string $profile, string $versionNumber, string $status, string $body)
    {
        $this->profile = $profile;
        $this->versionNumber = $versionNumber;
        $this->status = $status;
        $this->body = $body;
    }

    public static function createInvalidResponse(Query $query): self
    {
        return new self($query->getProfileName(), $query->getVersionNumber(), self::INVALID, '');
    }

    public static function createValidResponse(Unit $unit): self
    {
        $profile = $unit->getProfile();
        return new self(
            $profile->getName()->getValue(),
            $profile->getVersion()->getValue(),
            self::DONE,
            $unit->getData()->getValue()
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
