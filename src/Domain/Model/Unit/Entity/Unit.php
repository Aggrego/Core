<?php

namespace TimiTao\Construo\Domain\Model\Unit\Entity;

use TimiTao\Construo\Domain\Model\ProgressBoard\Entity\Board;
use TimiTao\Construo\Domain\ValueObject\Data;
use TimiTao\Construo\Domain\ValueObject\Key;
use TimiTao\Construo\Domain\ValueObject\Profile;
use TimiTao\Construo\Domain\ValueObject\Uuid;

class Unit
{
    /** @var Uuid */
    private $uuid;

    /** @var Key */
    private $key;

    /** @var Profile */
    private $profile;

    /** @var Data */
    private $data;

    private function __construct(Uuid $uuid, Key $key, Profile $profile, Data $data)
    {
        $this->uuid = $uuid;
        $this->key = $key;
        $this->profile = $profile;
        $this->data = $data;
    }

    public static function createFromBoard(Board $board): self
    {
        return new self(
            $board->getUuid(),
            $board->getKey(),
            $board->getProfile(),
            new Data('')
        );
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

    public function getData(): Data
    {
        return $this->data;
    }
}
