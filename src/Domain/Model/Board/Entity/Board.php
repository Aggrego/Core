<?php

namespace TimiTao\Construo\Domain\Model\Board\Entity;

use TimiTao\Construo\Domain\Model\Board\ValueObject\Key;
use TimiTao\Construo\Domain\Model\Board\ValueObject\Profile;
use TimiTao\Construo\Domain\Model\Board\ValueObject\Shards;
use TimiTao\Construo\Domain\Model\Board\ValueObject\Status;

class Board
{
    /** @var Key */
    private $key;

    /** @var Status */
    private $status;

    /** @var Profile */
    private $profile;

    /** @var Shards */
    private $shards;

    public function __construct(Key $key, Profile $profile, Shards $shards)
    {
        $this->status = new Status(Status::INITIAL);
        $this->key = $key;
        $this->profile = $profile;
        $this->shards = $shards;
    }

    public function getKey(): Key
    {
        return $this->key;
    }

    public function getStatus(): Status
    {
        return $this->status;
    }

    public function getProfile(): Profile
    {
        return $this->profile;
    }

    public function getShards(): Shards
    {
        return $this->shards;
    }
}
