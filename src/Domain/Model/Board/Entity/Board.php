<?php

namespace TimiTao\Construo\Domain\Model\Board\Entity;

use Ramsey\Uuid\Uuid as RamseyUuid;
use TimiTao\Construo\Domain\ValueObject\Key;
use TimiTao\Construo\Domain\ValueObject\Profile;
use TimiTao\Construo\Domain\ValueObject\Uuid;

abstract class Board
{
    /** @var Uuid */
    private $uuid;

    /** @var Key */
    private $key;

    /** @var Profile */
    private $profile;

    protected function __construct(Key $key, Profile $profile)
    {
        $this->uuid = new Uuid(
            RamseyUuid::uuid5(
                RamseyUuid::NAMESPACE_DNS,
                serialize($key->getValue()) . $profile
            )->toString()
        );
        $this->key = $key;
        $this->profile = $profile;
    }

    public function getUuid(): Uuid
    {
        return $this->uuid;
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
