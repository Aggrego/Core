<?php

namespace Aggrego\Domain\Api\Domain\Command\CreateBoard;

use Aggrego\Domain\Profile\Profile;
use Aggrego\Domain\Shared\ValueObject\Key;

class Command
{
    /** @var Key */
    private $key;

    /** @var Profile Profile */
    private $profile;

    public function __construct(array $key, string $profileName, string $versionNumber)
    {
        $this->key = new Key($key);
        $this->profile = Profile::createFrom($profileName, $versionNumber);
    }

    public function getKey(): Key
    {
        return $this->key;
    }

    public function getProfile(): Profile
    {
        return $this->profile;
    }
}
